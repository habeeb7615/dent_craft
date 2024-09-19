<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quotation\UpdateRequest;
use App\Models\CannedComment;
use App\Models\CustomerDetail;
use App\Models\DamagedArea;
use App\Models\Notification;
use App\Models\Part;
use App\Models\PreExistingCondition;
use App\Models\Quote;
use App\Models\State;
use App\Models\User;
use App\Notifications\SendMailAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use Image;
use Maestroerror\HeicToJpg;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->damagedAreasTotal = 0;
        $this->partsTotal = 0;

        $this->data = [];
    }
    public function myQuotations(Request $request)
    {
        if ($request->ajax()) {
            $latest_quotes = Quote::select('id', 'quote_id', 'quote_status', 'created_at')->with(['customer_detail:id,quote_id,customer_name,technician', 'vehicle_detail:id,quote_id,vin_number,reg_number']);
            if ($request->has('search') && !is_null($request->search) && $request->search !== '') {
                $latest_quotes->whereHas('customer_detail', function ($query)
                {
                    $query->where('customer_name', 'LIKE', '%'.request()->search.'%')
                                ->orWhere('technician', 'LIKE', '%'.request()->search.'%');
                })
                ->orWhereHas('vehicle_detail', function ($query)
                {
                    $query->where('vin_number', 'LIKE', '%'.request()->search.'%')
                                ->orWhere('reg_number', 'LIKE', '%'.request()->search.'%');
                });
            }

            $latest_quotes = $latest_quotes->latest()->get();

            return datatables()->of($latest_quotes)
                        ->editColumn('quote_id', function ($row)
                        {
                            return $row->quote_id;
                        })
                        ->editColumn('quote_date', function ($row)
                        {
                            return $row->created_at->timezone(auth()->user()->company_detail->timezone)->format('d-m-Y h:i:s A');
                        })
                        ->editColumn('customer_name', function ($row)
                        {
                            return $row->customer_detail ? $row->customer_detail->customer_name : '--';
                        })
                        ->editColumn('technician', function ($row)
                        {
                            return $row->customer_detail ? $row->customer_detail->technician : '--';
                        })
                        ->editColumn('status', function ($row)
                        {
                            return $row->quote_status;
                        })
                        ->addColumn('actions', function ($row)
                        {
                            return '<span class="custom-mobile-table1">
                                <a title="View Details" href="'.route('admin.quotation.quotation_summary', base64_encode($row->id)).'">
                                    <i class="la la-eye"></i>
                                </a>
                                <a title="Edit Quote" href="'.route('admin.quotation.new_quotation', base64_encode($row->id)).'"><i class="la la-edit" aria-hidden="true"></i></a></span>
                                <a title="Edit Quote Summary" href="'.route('admin.quotation.edit_quote_summary', base64_encode($row->id)).'"><i style="color:#25d4a3" class="la la-edit" aria-hidden="true"></i></a>



                                <a title="Delete Quote" onclick="return confirm(`Are you sure Delete Quote?`)" href="'.route('admin.quotation.delete_quote', base64_encode($row->id)).'"><i class="la  la-trash danger" aria-hidden="true"></i> </a>';
                        })
                        ->rawColumns(['actions'])
                        ->make();
        }
        $search = $request->has('search') ? $request->search : '';
        return view('pages.my_quotations', compact('search'));
    }

    public function quotationSummary($encodedId=null)
    {
        $quote = Quote::with([
            'customer_detail',
            'vehicle_detail',
            'images',
            'damaged_areas',
            'damaged_areas.guards',
            'parts',
            'additional_value',
            'discount',
        ])->where('id', base64_decode($encodedId))->whereNull('deleted_at')->first();

        if (!$quote) {
            return redirect(route('home'));
        }

        $companyDetail = User::select('id');
        if (auth()->user()) {
            $companyDetail = $companyDetail->whereId(auth()->user()->id);
        }
        $companyDetail = $companyDetail->with('company_detail')->first()->company_detail;
        $damagedAreas = DamagedArea::with('guards')->get();


        $leftDamagedAreas = $damagedAreas->filter(function ($area) {
            return $area->position == 'left';
        });
        $rightDamagedAreas = $damagedAreas->filter(function ($area) {
            return $area->position == 'right';
        });

        $parts = Part::select('id', 'position', 'part_name')->get();

        $leftParts = $parts->filter(function($part) {
            return $part->position == 'left';
        });

        $rightParts = $parts->filter(function($part) {
            return $part->position == 'right';
        });

        $noneParts = $parts->filter(function($part) {
            return $part->position == 'none';
        });

        $quote->damaged_areas->map(function($area) {
            $area->guards->map(function($guard) {
                $this->damagedAreasTotal += $guard->pivot->panel_cost;
            });
        });
        $additional_string = "";
        $additional = [];
          if(count($quote->damaged_areas) > 0){
         foreach($quote->damaged_areas as  $area) {
           foreach ($area->guards as  $value) {
            array_push($additional,$value->name);
           }
          }
          $additional_string=implode(",",$additional);
        }


        $quote->parts->map(function($part) {
            $this->partsTotal += $part->pivot->part_total;
        });

        // $subTotal = $this->damagedAreasTotal + $this->partsTotal;
        $subTotal = $this->damagedAreasTotal;

        $partsTotal = $this->partsTotal;

        $discountPrice = $quote->discount ? ($quote->discount->percent_discount * $subTotal)/100 : 0;

        $gstPrice = $companyDetail && $companyDetail->check_gst ? ($companyDetail->gst * ($subTotal + $partsTotal - $discountPrice))/100 : 0;

        $total = $subTotal - $discountPrice + $partsTotal + $gstPrice;

        if (request()->has('email')) {
            $notification = Notification::whereQuoteId($quote->id)->whereType('summary_viewed')->first();
            // if (request()->has('email')) {
            //     $notification = $notification->whereToEmail(request()->email);
            // }
            // $notification = $notification->first();
            $user = User::first();

            if (!$notification) {
                $notification = new Notification();
                $notification->quote_id = $quote->id;
                $notification->user_id = $user->id;
                $notification->to_email = $quote->customer_detail->send_email_to_customer ? $quote->customer_detail->email : (auth()->user() ? auth()->user()->email : $user->company_detail->email);
                $notification->name = $quote->quote_id;
                $notification->type = 'summary viewed';

                $notification->save();
            }
        }

        if (auth()->user()) {
            return view('pages.quotation.quotation_summary', compact('quote','additional','additional_string', 'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'leftParts', 'rightParts', 'noneParts', 'partsTotal'));
        } else {
            return view('pages.quotation.quotation_summary_common', compact('quote','additional','additional_string' ,'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'leftParts', 'rightParts', 'noneParts', 'partsTotal'));
        }

    }

    public function printSummary($encodedId)
    {
        $quote = Quote::with([
            'customer_detail',
            'vehicle_detail',
            'images',
            'damaged_areas',
            'damaged_areas.guards',
            'parts',
            'additional_value',
            'discount',
        ])->where('id', base64_decode($encodedId))->first();

        $companyDetail = User::select('id');
        if (auth()->user()) {
            $companyDetail = $companyDetail->whereId(auth()->user()->id);
        }
        $companyDetail = $companyDetail->with('company_detail')->first()->company_detail;
        $damagedAreas = DamagedArea::with('guards')->get();

        $leftDamagedAreas = $quote->damaged_areas->filter(function ($area, $key) use ($quote) {
            return $key < $quote->damaged_areas->count()/2;
        });

        $rightDamagedAreas = $quote->damaged_areas->filter(function ($area, $key) use ($quote) {
            return $key >= $quote->damaged_areas->count()/2;
        });

        $parts = Part::select('id', 'position', 'part_name')->get();

        $leftParts = $quote->parts->filter(function ($area, $key) use ($quote) {
            return $key < $quote->parts->count()/2;
        });

        $rightParts = $quote->parts->filter(function ($area, $key) use ($quote) {
            return $key >= $quote->parts->count()/2;
        });

        $quote->damaged_areas->map(function($area) {
            $area->guards->map(function($guard) {
                $this->damagedAreasTotal += $guard->pivot->panel_cost;
            });
        });

        $quote->parts->map(function($part) {
            $this->partsTotal += $part->pivot->part_total;
        });

        // $subTotal = $this->damagedAreasTotal + $this->partsTotal;
        $subTotal = $this->damagedAreasTotal;

        $partsTotal = $this->partsTotal;

        $discountPrice = $quote->discount ? ($quote->discount->percent_discount * $subTotal)/100 : 0;

        $gstPrice = $companyDetail && $companyDetail->check_gst ? ($companyDetail->gst * ($subTotal + $partsTotal - $discountPrice))/100 : 0;

        $total = $subTotal - $discountPrice + $partsTotal + $gstPrice;
        $user = User::whereId('1')->with('company_detail')->first();

        return view('pages.quotation.print_summary', compact('quote', 'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'leftParts', 'rightParts', 'partsTotal','user'));

        // $pdf = app('dompdf.wrapper');
        // return $pdf->loadView('pages.quotation.print_summary', compact('quote', 'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'leftParts', 'rightParts', 'partsTotal'))->stream();
    }

    public function profileSettings()
    {
        $user = User::whereId(auth()->user()->id)->with('company_details', 'canned_comments')->first();

        return view('pages.profile_settings', compact('user'));
    }

    public function create(Request $request, $encodedId=null)
    {


        $preCon = PreExistingCondition::select('id', 'name')->get();
        $cannedComments = CannedComment::select('id', 'title', 'comment')->get();
        $damagedAreas = DamagedArea::select('id', 'panel_area_name', 'position')->whereNull('quote_id')->with(['guards', 'quotes'])->get();
 
        $leftParts = Part::where('position', 'left')->whereNull('quote_id')->get();
        $rightParts = Part::where('position', 'right')->whereNull('quote_id')->get();
        $noneParts = Part::where('position', 'none')->whereNull('quote_id')->get();
        $states = State::all();
        $preExistingConditions = PreExistingCondition::orderBy('name')->get();
        $customers = CustomerDetail::where('customer_name', '<>', '')->get();

        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        $upload_mb = min($max_upload, $max_post, $memory_limit);

        if (!is_null($encodedId)) {
            $id = base64_decode($encodedId);
            $quote = Quote::with([
                'customer_detail',
                'vehicle_detail',
                'images',
                'damaged_areas',
                'parts',
                'additional_value',
                'discount',
                'pre_existing_conditions'
            ])->whereId($id)->first();

            return view('pages.quotation.new_quotation', compact('quote', 'preCon', 'cannedComments', 'damagedAreas', 'leftParts', 'rightParts', 'noneParts', 'upload_mb', 'states', 'preExistingConditions', 'customers'));
        }
        return view('pages.quotation.new_quotation', compact('preCon', 'cannedComments', 'damagedAreas', 'leftParts', 'rightParts', 'noneParts', 'upload_mb', 'states', 'preExistingConditions', 'customers'));
    }

    public function editQuote($encodedId)
    {
        $data = [];

        $data['preCon'] = PreExistingCondition::select('id', 'name')->get();
        $data['cannedComments'] = CannedComment::select('id', 'title', 'comment')->get();
        $data['damagedAreas'] = DamagedArea::select('id', 'panel_area_name')->whereNull('quote_id')->with(['guards', 'quotes'])->get();
        $data['leftParts'] = Part::where('position', 'left')->whereNull('quote_id')->get();
        $data['rightParts'] = Part::where('position', 'right')->whereNull('quote_id')->get();
        $data['noneParts'] = Part::where('position', 'none')->whereNull('quote_id')->get();
        $data['states'] = State::all();
        $data['preExistingConditions'] = PreExistingCondition::orderBy('name')->get();
        $data['customers'] = CustomerDetail::where('customer_name', '<>', '')->get();

        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        $data['upload_mb'] = min($max_upload, $max_post, $memory_limit);


        $data['quote'] = Quote::with([
            'customer_detail',
            'vehicle_detail',
            'images',
            'damaged_areas',
            'damaged_areas.guards',
            'parts',
            'additional_value',
            'discount',
        ])->where('id', base64_decode($encodedId))->first();

        $data['leftCustomParts'] = $data['quote']->custom_parts()->wherePosition('left')->get();
        $data['rightCustomParts'] = $data['quote']->custom_parts()->wherePosition('right')->get();
        $data['noneCustomParts'] = $data['quote']->custom_parts()->wherePosition('none')->get();

        $data['customDamagedAreas'] = $data['quote']->custom_damaged_areas()->with(['guards', 'quotes'])->get();

        return view('pages.quotation.edit_quotation', $data);
    }

    public function edit($encodedId)
    {
        $quote = Quote::with([
            'customer_detail',
            'vehicle_detail',
            'images',
            'damaged_areas',
            'parts',
            'additional_value',
            'discount',
        ])->where('id', base64_decode($encodedId))->first();

        $user = User::select('id');
        if (auth()->user()) {
            $user = $user->whereId(auth()->user()->id);
        }
        $companyDetail = $user->with('company_detail')->first()->company_detail;
        $damagedAreas = DamagedArea::all();
        $leftDamagedAreas = $damagedAreas->filter(function ($area) {
            return $area->position == 'left';
        });
        $rightDamagedAreas = $damagedAreas->filter(function ($area) {
            return $area->position == 'right';
        });

        $parts = Part::select('id', 'part_name')->get();

        $quote->damaged_areas->map(function($area) {
            $area->guards->map(function($guard) {
                $this->damagedAreasTotal += $guard->pivot->panel_cost;
            });
        });

        $quote->parts->map(function($part) {
            $this->partsTotal += $part->pivot->part_quantity * $part->unit_price;
        });

        // $subTotal = $this->damagedAreasTotal + $this->partsTotal;
        $subTotal = $this->damagedAreasTotal;

        $partsTotal = $this->partsTotal;

        $discountPrice = $quote->discount ? ($quote->discount->percent_discount * $subTotal)/100 : 0;

        $gstPrice = $companyDetail ? ($companyDetail->gst * ($subTotal + $partsTotal - $discountPrice))/100 : 0;

        $total = $subTotal - $discountPrice + $partsTotal + $gstPrice;


        return view('pages.quotation.quotation_summary_edit', compact('quote', 'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'partsTotal'));
    }

    public function customerSearch(Request $request)
    {
        $customerDetail = CustomerDetail::where('customer_name', 'LIKE', '%'.$request->term.'%')->whereUserId(auth()->user()->id)->orderBy('customer_name')->get();

        return response(['data' => $customerDetail]);
    }

    public function getCustomer(Request $request)
    {
        $customerDetail = CustomerDetail::whereCustomerName($request->id)->first();

        return response(['data' => $customerDetail]);
    }

    public function submitPageData(Request $request)
    {
       
        
        
        DB::beginTransaction();

        $customerDetails = $request->customer_details;
        $customerDetails['user_id'] = auth()->user()->id;
        $customerDetails['send_email_to_customer'] = Arr::has($request->customer_details, 'send_email_to_customer') ? 1 : 0;

        $vehicleDetails = $request->vehicle_details;
         // Ankit code

        $state_id_get= State::whereStateCode($request->vehicle_details['state'])->first();
        if(is_null($state_id_get)){
        $state_id  = $state_id_get;
        }else{
            $state_id = $state_id_get->id;
        }
        $vehicleDetails['state_id'] = $request->vehicle_details['state'] ? $state_id : null;
        // $vehicleDetails['state_id'] = $request->vehicle_details['state'] ? State::whereStateCode($request->vehicle_details['state'])->first()->id : null;
        //Ankit code end

       
        // DB::table('quotes')->insert([
        //      'added_by' => auth()->user()->id , 
        //      'quote_id' => Carbon::now()->format('Uu_'),
        //      'attach_images_in_email' => Arr::has($request->images, 'attach_images_in_email') ? 1 : 0,
        //      'image_notes' =>  $request->images['image_notes'], 
        // ]);

        // DB::commit();

        
        $quote =  new Quote; 
        $quote->added_by = auth()->user()->id;
        $quote->quote_id = Carbon::now()->format('Uu_');
        $quote->attach_images_in_email = Arr::has($request->images, 'attach_images_in_email') ? 1 : 0;
        $quote->image_notes = $request->images['image_notes'];
        $quote->save();
        
   
        $quote->customer_detail()->create($customerDetails);
        $quote->vehicle_detail()->create($vehicleDetails);
        if (!is_null($vehicleDetails['state_id'])) {
            $quote->quote_id = $quote->quote_id.$vehicleDetails['reg_number'];
            $quote->save();
        }
        
        
        $assessedDamage = 0;
        $preExistingCondition = 0;
        
       // DB::commit();
        while($request->has('uploaded_assessed_image'.$assessedDamage)) {
            
               $path = public_path('/user-uploads/quotation-images/'.$quote->id);
            $request['uploaded_assessed_image'.$assessedDamage]->move($path,$request['uploaded_assessed_image'.$assessedDamage]->getClientOriginalName());
            $image_size = filesize($path.'/'.$request['uploaded_assessed_image'.$assessedDamage]->getClientOriginalName());
            $quote->images()->create([
                'image_url' => $request['uploaded_assessed_image'.$assessedDamage]->getClientOriginalName(),
                'image_size' => $image_size,
                'image_type' => 'assessed_damage'
            ]);
            $assessedDamage++;
        }
          if($request->has('uploaded_pre_image')){
              
               if(count($request->uploaded_pre_image) >0){
               foreach ($request->uploaded_pre_image as $image){
                //   dd($image->getClientOriginalName());
              $path = public_path('user-uploads/quotation-images/'.$quote->id);
               $image->move($path,$image->getClientOriginalName());
               $image_size = filesize($path.'/'.$image->getClientOriginalName());
                $quote->images()->create([
                'image_url' =>$image->getClientOriginalName(),
                'image_size' => $image_size,
                'image_type' => 'pre_existing_condition'
            ]);
              
          }
     
          }
              
              
              
          }
         
         
        //  while($request->has('uploaded_pre_image'.$preExistingCondition)) {
        //       $path = public_path('user-uploads/quotation-images/'.$quote->id);
               
        //     $request['uploaded_pre_image'.$preExistingCondition]->move($path,$request['uploaded_pre_image'.$preExistingCondition]->getClientOriginalName());
        //     $image_size = filesize($path.'/'.$request['uploaded_pre_image'.$preExistingCondition]->getClientOriginalName());
        //     $quote->images()->create([
        //         'image_url' => $request['uploaded_pre_image'.$preExistingCondition]->getClientOriginalName(),
        //         'image_size' => $image_size,
        //         'image_type' => 'pre_existing_condition'
        //     ]);
        //     $preExistingCondition++;
        // }       
                
        
                
                
                
                
        // while($request->has('uploaded_pre_image'.$preExistingCondition)) {
        //     $path = public_path('/user-uploads/quotation-images/'.$quote->id);
        //     $request['uploaded_pre_image'.$preExistingCondition]->move($path,$request['uploaded_pre_image'.$preExistingCondition]->getClientOriginalName());
        //     $image_size = filesize($path.'/'.$request['uploaded_pre_image'.$preExistingCondition]->getClientOriginalName());
        //     // $image_size = Storage::size($path);
        //     $quote->images()->create([
        //         'image_url' => $request['uploaded_pre_image'.$preExistingCondition]->getClientOriginalName(),
        //         'image_size' => $image_size,
        //         'image_type' => 'pre_existing_condition'
        //     ]);
        //     $preExistingCondition++;
        // }

        if (Arr::has($request->images, 'precon')) {
            $quote->pre_existing_conditions()->sync($request->images['precon']);
        }

        // damaged areas
        foreach($request->damaged_areas as $areaId => $guards) {
            $guardIds = [];
            $addArea = false;
              
            if (Str::contains($areaId, 'custom')) {
                $damagedArea = $quote->custom_damaged_areas()->create([
                      'quote_id' => $quote->id,
                    'added_by' => auth()->user()->id,
                    'panel_area_name' => $guards[0]['panel_area_name'],
                    'position' => $guards[0]['position']
                ]);
                 
            }

            foreach ($guards as $guard) {
                if ($guard['price'] > 0) {
                    $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['price']]);
                    $addArea = true;
                }
            }
            if (Str::contains($areaId, 'custom')) {
                if ($addArea) {
                    $quote->damaged_areas()->attach($damagedArea->id);
                }

                $damagedArea->guards()->sync($guardIds);
            } else {
                if ($addArea) {
                    $quote->damaged_areas()->attach($areaId);
                }

                DamagedArea::whereId($areaId)->first()->guards()->sync($guardIds);
            }
        }

        // parts
        $partIds = [];
        $part = '';
        foreach($request->parts as $partId => $part_details) {
            if (Str::contains($partId, 'custom')) {
                $part = $quote->custom_parts()->create([
                    'added_by' => auth()->user()->id,
                    'part_name' => $part_details['part_name'],
                    'position' => $part_details['position']
                ]);
            }
            if (Arr::has($part_details, 'part_id')) {
                if (Str::contains($partId, 'custom')) {
                    $partIds = Arr::add($partIds, $part->id, ['part_quantity' => $part_details['quantity'], 'part_total' => $part_details['total_price']]);
                }else {
                    $partIds = Arr::add($partIds, $partId, ['part_quantity' => $part_details['quantity'], 'part_total' => $part_details['total_price']]);
                }
            }
        }
        $quote->parts()->sync($partIds);

        // additional values
        $quote->additional_value()->create($request->additional_values);

        // discount
        $quote->discount()->create($request->discounts);

        $notification = new Notification();
        $notification->quote_id = $quote->id;
        $notification->user_id = auth()->user()->id;
        $notification->to_email = $quote->customer_detail->send_email_to_customer ? $quote->customer_detail->email : auth()->user()->email;
        $notification->name = $quote->quote_id;
        $notification->type = 'quote';

        $notification->save();

        DB::commit();

        // return redirect(route('admin.dashboard'));
        return response()->json([
            'response_code' => 200,
            'message' => 'Quotation generated successfully.',
            'data' => [
                'quote_id' => $quote->id
            ]
        ]);
    }

    public function cancelQuote()
    {
        // TODO
    }

    public function approveCurrentQuote(Request $request)
    {
        // TODO create notification to customer or admin
        $notification = Notification::whereQuoteId($request->main_id)->whereType(0)->first();

        if (!$notification) {
            $quote = Quote::whereId($request->main_id)->first();

            $notification = new Notification();
            $notification->quote_id = $quote->id;
            $notification->user_id = auth()->user()->id;
            $notification->to_email = $quote->customer_detail->email;
            $notification->name = $quote->quote_id;
            $notification->type = 'quote';

            $notification->save();
        }

        return response([]);

    }

    public function destroy($encodedId)
    {
        $quote = Quote::whereId(base64_decode($encodedId))->first();
        $quote->delete();

        return redirect(route('admin.dashboard'));
    }

    public function checkVehicalReg(Request $request)
    {
        // validations
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'state' => 'required_if:type,0',
            'reg' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        // $registration = $request->reg;
        $registration = 'XXXXXXXXXXXXXXXXX';

        // check if car is stolen
        if ($request->type == 0) {
            $carData = $request->all();
            // $stolenData = '{"query":"query {\n  nevdisPlateSearch(plate: \"'.$registration.'\" , state: '.$request->state.'  ) {\n    vin\n  plate {\n  number\n state\n  }\n stolen{\n type\n }\n }\n}"}';
            // $carData = '{"query":"query {\n  nevdisPlateSearch(plate: \"'.$registration.'\" , state: '.$request->state.'  ) {\n    vin\n  plate {\n  number\n state\n    }\n    make\n    model\n colour\n chassis\n year_of_manufacture\n vehicle_type\n   compliance_plate\n engine_number\n vehicle_type\n    body_type\n   registration {\n status\n expiry_date\n }\n   wov {\n type_code\n jurisdiction\n damage_codes\n incident_recorded_date\n incident_code\n }\n   factory{\n    make\n    model\n    series\n    variant\n    buildYear\n    MY\n    body\n    fuel\n    drive\n    cylinders\n    litres\n    transmission\n  }\n  }\n}"}';
        }else {
            $carData =$request->all();
        //     $stolenData = '{"query":"query {\n  nevdisVINSearch_v2(vin: \"'.$registration.'\"  ) {\n    vin\n  plate {\n  number\n state\n  }\n stolen{\n type\n }\n }\n}"}';
        //     $carData = '{"query":"query {\n  nevdisVINSearch_v2(vin: \"'.$registration.'\"  ) {\n    vin\n  plate {\n  number\n state\n    }\n    make\n    model\n colour\n chassis\n year_of_manufacture\n vehicle_type\n   compliance_plate\n engine_number\n vehicle_type\n    body_type\n   registration {\n status\n expiry_date\n }\n   wov {\n type_code\n jurisdiction\n damage_codes\n incident_recorded_date\n incident_code\n }\n   factory{\n    make\n    model\n    series\n    variant\n    buildYear\n    MY\n    body\n    fuel\n    drive\n    cylinders\n    litres\n    transmission\n  }\n  }\n}"}';
        }

        $check = $this->getCarDataApi($carData);

        $data = json_decode($check, true);
        $res = [];

        if ($request->type == '1') {
            $res=$this->getCarDataApi($carData);
            $res = json_decode($res, true);
            // $res = $res['data']['nevdisVINSearch_v2'][0];
            // if($data['data']['nevdisVINSearch_v2'][0]['stolen']==NULL){
                $res['stolen']='';
            // }else{
            //     $res['stolen']='yes';
            // }
        } else {
            $res=$this->getCarDataApi($carData);
            $res = json_decode($res, true);

            // $res = $res['data']['nevdisPlateSearch'];
            // if($data['data']['nevdisPlateSearch']['stolen']==NULL){
                $res['stolen']='';
            // }else{
            //     $res['stolen']='yes';
            // }
        }

        return response($res);
    }

    public function getSummaryData($quote, $discount)
    {
        $user = User::select('id');
        if (auth()->user()) {
            $user = $user->whereId(auth()->user()->id);
        }
        $this->data['companyDetail'] = $user->with('company_detail')->first()->company_detail;
        $this->data['damagedAreas'] = DamagedArea::with('guards')->get();
        $this->data['leftDamagedAreas'] = $this->data['damagedAreas']->filter(function ($area) {
            return $area->position == 'left';
        });
        $this->data['rightDamagedAreas'] = $this->data['damagedAreas']->filter(function ($area) {
            return $area->position == 'right';
        });

        $this->data['parts'] = Part::select('id', 'part_name')->get();

        $quote->damaged_areas->map(function($area) {
            $area->guards->map(function($guard) {
                $this->damagedAreasTotal += $guard->pivot->panel_cost;
            });
        });

        $quote->parts->map(function($part) {
            $this->partsTotal += $part->pivot->part_quantity * $part->pivot->part_price;
        });

        $this->data['subTotal'] = $this->damagedAreasTotal;

        $this->data['partsTotal'] = $this->partsTotal;

        $this->data['discountPrice'] = $quote->discount ? ($discount->percent_discount * $this->data['subTotal'])/100 : 0;

        $this->data['gstPrice'] = $this->data['companyDetail'] ? ($this->data['companyDetail']->gst * ($this->data['subTotal'] + $this->data['partsTotal'] - $this->data['discountPrice']))/100 : 0;

        $this->data['total'] = $this->data['subTotal'] - $this->data['discountPrice'] + $this->data['partsTotal'] + $this->data['gstPrice'];

        $this->data['quote'] = $quote;
    }

    public function submitSummary(Request $request)
    {
        // Send email to customer or admin based on admin preference
        $quote = Quote::whereId($request->id)->with(['customer_detail', 'vehicle_detail'])->first();
       
        $quote->quote_status = 'submitted';
        $quote->save();
        
        
        $email_subject =auth()->user()->company_detail->email_subject;
        $data = [];
        $template = $request->email_temp;

        foreach (explode(',', $request->emails_multi) as $email) {
            $template = str_replace('{EMAIL}', $email, $template);
            $data['template'] = $template;
            $data['email'] = $email;
             $data['subject'] = $email_subject;
            $data['name'] = 'Customer';
            FacadesNotification::route('mail', $email)->notify(new SendMailAttachment($quote, $data));
        }

        $notification = Notification::whereQuoteId($quote->id)->whereType('email')->first();

        if (!$notification) {
            $notification = new Notification();
            $notification->quote_id = $quote->id;
            $notification->user_id = auth()->user()->id;
            $notification->to_email = $quote->customer_detail->send_email_to_customer ? $quote->customer_detail->email : auth()->user()->email;
            $notification->name = $quote->quote_id;
            $notification->type = 'email';

            $notification->save();
        }

        // if ($quote->customer_detail->send_email_to_customer) {
        //     $data['email'] = $quote->customer_detail->email;
        //     $data['name'] = $quote->customer_detail->customer_name;
        //     $quote->customer_detail->notify(new SendMailAttachment($quote, $data));
        // }
        // else {
        //     $data['email'] = auth()->user()->email;
        //     $data['name'] = auth()->user()->name;
        //     auth()->user()->notify(new SendMailAttachment($quote, $data));
        // }

        return response(['success' => 1]);
    }

    public function updateQuote(Request $request, $quoteId)
    {
       
        // dd($request->all(),$quoteId);
        // validations
        $validator = Validator::make($request->all(), [
            // 'customer_details.customer_name' => 'required|string',
            // 'customer_details.contact_number' => 'required',
            // 'customer_details.address' => 'required',
            // 'customer_details.email' => 'required|email',
            // 'customer_details.technician' => 'required',
            // 'customer_details.estimator' => 'required',
            // 'additional_values.details' => 'required',
            // 'discounts.percent_discount' => 'required',
            // 'images.assessed_damage' => 'array',
            // 'images.pre_existing_condition' => 'array',
            // 'images.assessed_damage.*' => 'image',
            // 'images.pre_existing_condition.*' => 'image'
        ], [
            // 'customer_details.customer_name.required' => 'Customer Name field is required.',
            // 'customer_details.contact_number.required' => 'Contact Number field is required.',
            // 'customer_details.address.required' => 'Address field is required.',
            // 'customer_details.email.required' => 'Email field is required.',
            // 'customer_details.technician.required' => 'Technician field is required.',
            // 'customer_details.estimator.required' => 'Estimator field is required.',
            // 'additional_values.details.required' => 'Details field is required.',
            // 'discounts.percent_discount.required' => 'Discount field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        $customerDetails = $request->customer_details;
        $customerDetails['user_id'] = auth()->user()->id;
        $customerDetails['send_email_to_customer'] = Arr::has($request->customer_details, 'send_email_to_customer') ? 1 : 0;

        $vehicleDetails = $request->vehicle_details;

        $vehicleDetails['state_id'] = $request->vehicle_details['state'] ? State::whereStateCode($request->vehicle_details['state'])->first()->id : null;

        $quote = Quote::whereId($quoteId)->first();
        $quote->quote_status = 'draft';
        $quote->added_by = auth()->user()->id;
        // $quote->quote_id = Carbon::now()->format('Uu_');
        $quote->attach_images_in_email = Arr::has($request->images, 'attach_images_in_email') ? 1 : 0;
        $quote->image_notes = $request->images['image_notes'];

        $quote->save();

        $quote->customer_detail()->update($customerDetails);
        if (!is_null($vehicleDetails['state_id'])) {
            $quote->quote_id = explode('_', $quote->quote_id)[0].'_'.$vehicleDetails['reg_number'];
            $quote->save();
            if ($quote->vehicle_detail) {
                $quote->vehicle_detail()->update($vehicleDetails);
            }else {
                $quote->vehicle_detail()->create($vehicleDetails);
            }
        }
                              
        $assessedImages = json_decode($request->assessed_damage, true);
          
        $preImages = json_decode($request->pre_existing_condition, true);

        $assessedImagesArr = $quote->assessed_images->pluck('id')->toArray();
        $preImagesArr = $quote->pec_images->pluck('id')->toArray();
       
        $filteredAssessedImages = array_filter($assessedImagesArr, function ($assessedImage) use ($assessedImages) {
            return !in_array($assessedImage, $assessedImages);
        });
        
        $filteredPreImages = array_filter($preImagesArr, function ($preImage) use ($preImages) {
            return !in_array($preImage, $preImages);
        });

        $path = public_path('/user-uploads/quotation-images/'.$quote->id);
               
        foreach ($filteredAssessedImages as $image) {
            $imageModel = $quote->assessed_images()->whereId($image)->first();
            Storage::delete($path.'/'.$imageModel->getRawOriginal('image_url'));
            $imageModel->delete();
        }

        foreach ($filteredPreImages as $image) {
            $imageModel = $quote->pec_images()->whereId($image)->first();
            Storage::delete($path.'/'.$imageModel->getRawOriginal('image_url'));
            $imageModel->delete();
        }
            //   $assessedDamage = 0 ;
     
        //       while($request->has('uploaded_assessed_image'.$assessedDamage)) {
        //           dd ($request['uploaded_assessed_image'.$assessedDamage]);
        //       $path = public_path('/user-uploads/quotation-images/'.$quote->id);
        //     $request['uploaded_assessed_image'.$assessedDamage]->move($path,$request['uploaded_assessed_image'.$assessedDamage]->getClientOriginalName());
        //     $image_size = filesize($path.'/'.$request['uploaded_assessed_image'.$assessedDamage]->getClientOriginalName());
        //     $quote->images()->create([
        //         'image_url' => $request['uploaded_assessed_image'.$assessedDamage]->getClientOriginalName(),
        //         'image_size' => $image_size,
        //         'image_type' => 'assessed_damage'
        //     ]);
        //     $assessedDamage++;
        // } 
         

        if (Arr::has($request->all(), 'uploaded_assessed_image')) {
            foreach ($request->uploaded_assessed_image as $image) {
                $path = public_path('/user-uploads/quotation-images/'.$quote->id);
                
                                 $image->move($path,$image->getClientOriginalName());
                              $image_size = filesize($path.'/'.$image->getClientOriginalName());
                         
                      $quote->images()->create([
                    'image_url' => $image->getClientOriginalName(),
                    'image_size' => $image_size,
                    'image_type' => 'assessed_damage'
                      ]);
                             
                     
           
            }
        }
          
       
                      
        if (Arr::has($request->all(), 'uploaded_pre_image')) {
            
            
            foreach ($request->uploaded_pre_image as $image) {
                $path = public_path('/user-uploads/quotation-images/'.$quote->id);
            
                
                $image->move($path,$image->getClientOriginalName());
                $image_size = filesize($path.'/'.$image->getClientOriginalName());


                $quote->images()->create([
                    'image_url' => $image->getClientOriginalName(),
                    'image_size' => $image_size,
                    'image_type' => 'pre_existing_condition'
                ]);
            }
        }

        if (Arr::has($request->images, 'precon')) {
            $quote->pre_existing_conditions()->sync($request->images['precon']);
        }

        // damaged areas
        $areaIds = [];
        foreach($request->damaged_areas as $areaId => $guards) {
            
            $guardIds = [];
            $addArea = false;

            if (Str::contains($areaId, 'custom')) {
                $damagedArea = $quote->custom_damaged_areas()->create([
                    'added_by' => auth()->user()->id,
                    'panel_area_name' => $guards[0]['panel_area_name'],
                    'position' => $guards[0]['position']
                ]);
            }

            foreach ($guards as $guard) {
                if ($guard['price'] > 0) {
                    $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['price']]);
                    $addArea = true;
                }
            }
            if (Str::contains($areaId, 'custom')) {
                if ($addArea) {
                    $areaIds[] = $damagedArea->id;
                }

                $damagedArea->guards()->sync($guardIds);
            } else {
                if ($addArea) {
                    $areaIds[] = $areaId;
                }

                DamagedArea::whereId($areaId)->first()->guards()->sync($guardIds);
            }
        }
        $quote->damaged_areas()->sync($areaIds);

        // parts
        $partIds = [];
        $part = '';

        foreach($request->parts as $partId => $part_details) {
            if (Str::contains($partId, 'custom')) {
                $part = $quote->custom_parts()->create([
                    'added_by' => auth()->user()->id,
                    'part_name' => $part_details['part_name'],
                    'position' => $part_details['position']
                ]);
            }
            if (Arr::has($part_details, 'part_id')) {
                if (Str::contains($partId, 'custom')) {
                    $partIds = Arr::add($partIds, $part->id, ['part_quantity' => $part_details['quantity'], 'part_total' => $part_details['total_price']]);
                }else {
                    $partIds = Arr::add($partIds, $partId, ['part_quantity' => $part_details
                    ['quantity'], 'part_total' => $part_details['total_price']]);
                }
            }
        }
        $quote->parts()->sync($partIds);

        // additional values
        $quote->additional_value()->update($request->additional_values);

        // discount
        $quote->discount()->update($request->discounts);

        DB::commit();

        return response()->json([
            'response_code' => 200,
            'message' => 'Quotation updated successfully.',
            'data' => [
                'quote_id' => $quote->id
            ]
        ]);
    }

    public function updateSummary(Request $request, $quoteId)
    {
        $customerDetails = $request->customer_details;
        $customerDetails['user_id'] = auth()->user()->id;

        $vehicleDetails = $request->vehicle_details;
        $vehicleDetails['state_id'] = $request->vehicle_details['state'] ? State::whereStateCode($request->vehicle_details['state'])->first()->id : null;

        $quote = Quote::whereId($quoteId)->first();

        $quote->added_by = auth()->user()->id;
        // $quote->quote_id = Carbon::now()->format('Uu_');
        // $quote->attach_images_in_email = Arr::has($request->images, 'attach_images_in_email') ? 1 : 0;
        // $quote->image_notes = $request->images['image_notes'];

        $quote->save();

        $quote->customer_detail()->update($customerDetails);
        $quote->quote_id = explode('_', $quote->quote_id)[0].'_'.$vehicleDetails['reg_number'];
        $quote->save();
        $quote->vehicle_detail()->update($vehicleDetails);
        // if (!is_null($vehicleDetails['state_id'])) {
        // }

        // damaged areas
        $areaIds = [];
        foreach($request->damaged_areas as $areaId => $guards) {
            $guardIds = [];
            $addArea = false;

            foreach ($guards as $guard) {
                if ($guard['price'] > 0) {
                    $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['price']]);
                    $addArea = true;
                }
            }
            if ($addArea) {
                $areaIds[] = $areaId;
            }

            DamagedArea::whereId($areaId)->first()->guards()->sync($guardIds);
        }
        $quote->damaged_areas()->sync($areaIds);

        // parts
        $partIds = [];
        foreach($request->parts as $partId => $part_details) {
            if ($part_details['quantity'] > 0) {
                $partIds = Arr::add($partIds, $partId, ['part_quantity' => $part_details['quantity']]);
            }
            if ($part_details['unit_price'] > 0) {
                $part = Part::whereId($partId)->first();

                $part->unit_price = $part_details['unit_price'];

                $part->save();
            }
        }
        $quote->parts()->sync($partIds);

        // additional values
        $quote->additional_value()->update($request->additional_values);

        // discount
        $quote->discount()->update($request->discounts);

        return response()->json([
            'response_code' => 200,
            'message' => 'Quotation summary updated successfully.',
            'data' => [
                'quote_id' => $quote->id
            ]
        ]);
    }

    public function getCarDataApi($postData)
    {
        // $accesstoken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJmYTE1YjI5ZC02YzNhLTRkNGEtOWU3ZC1lZmI4MWFmZjExMzIiLCJuYW1lIjoiRGVudGZpeCBQdHkgTHRkIiwiaWF0IjoxNTE2MjM5MDIyLCJ2ZXJzaW9uIjoyfQ.4KaKG69gVpfVtuna8-bqwVYvT53ws4gUtVC2HcUOfYE';
        //             $vin = 'KMHH351EMKU00TEST';
        // dd($postData);
        $url = '';
        if($postData['type'] == 0){
            $plate = $postData['reg'];
            $state = $postData['state'];
            $url = 'https://api.blueflag.com.au/nevdis/vehicle_details_build_and_compliance?plate='.$plate.'&state='.$state;

        }
        if($postData['type'] == 1){
            $vin = $postData['reg'];
            $url = 'https://api.blueflag.com.au/nevdis/vehicle_details_build_and_compliance?vin='.$vin;

        }
              $ch = curl_init($url);
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $headers = array(
                "Accept: application/json",
                "Authorization: secret_LIVE_X4qIbHRkkj4t4GhtLi66V5Y8yhxWCjt51n1Vx2uI_o-xIBY6UgJG",
             );
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             //for debug only!
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

             $resp = curl_exec($ch);
             curl_close($ch);
             return $resp;














        // $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if (curl_errno($ch)) {

        //     return 'Error:' . curl_error($ch);
        //     curl_close($ch);
        // }else{

        //     curl_close($ch);
        //     return $result;
        // }

    }

    public function addCustomDamagedArea(Request $request)
    {



        // validations
        $validator = Validator::make($request->all(), [
            'panel_area_name' => 'required',
            'position' => 'required|in:left,right,default'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        // $damagedArea = new DamagedArea();

        // $damagedArea->added_by = auth()->user()->id;
        // $damagedArea->panel_area_name = $request->panel_area_name;
        // $damagedArea->position = $request->position;

        // $damagedArea->save();
        if($request->position == "default"){
           $panel_area = ucwords($request->panel_area_name);
        }else{
           $panel_area = ucwords($request->position . " ".$request->panel_area_name);

        }

        $damagedArea = [
            'id' => $request->id,
            'panel_area_name' => $panel_area,
            'position' => $request->position
        ];

        $count = $request->count;


        $view = view('pages.quotation.partials.damaged_area', ['damagedArea' => $damagedArea, 'damagedAreasCount' => $count])->render();

        return response()->json([
            'response_code' => 200,
            'view' => $view,
            'damaged_area' => $damagedArea,
            'damaged_areas_count' => $count
        ]);
    }

    public function addCustomPart(Request $request)
    {
        // validations
        $validator = Validator::make($request->all(), [
            'part_name' => 'required',
            // 'unit_price' => 'required',
            'position' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }
        
        if($request->position == "none"){
            $panel_area = ucwords($request->part_name);
         }else{
            $panel_area = ucwords($request->position . " ".$request->part_name);

         }

        // $part = new Part();

        // $part->added_by = auth()->user()->id;
        // $part->part_name = $request->part_name;
        // $part->position = $request->position;
        // $part->unit_price = $request->unit_price;

        // $part->save();

        $part = [
            'id' => $request->id,
            'position' => $request->position,
            'part_name' => $panel_area
        ];

        $view = view('pages.quotation.partials.part', ['part' => $part])->render();

        return response()->json([
            'response_code' => 200,
            'view' => $view,
            'part' => $part
        ]);
    }
}

