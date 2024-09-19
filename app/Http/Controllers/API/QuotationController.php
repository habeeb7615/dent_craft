<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationCollection;
use App\Models\CannedComment;
use App\Models\CompanyDetail;
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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use mikehaertl\wkhtmlto\Pdf;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->damagedAreasTotal = 0;
        $this->partsTotal = 0;
    }

    public function index(Request $request)
    {
        $quote = Quote::with([
            'customer_detail',
            'assessed_images'
        ])->orderBy('created_at', 'desc');

        if (!is_null($request->date_from) && !is_null($request->date_to)) {
            $quote = $quote->whereDate('created_at', '>=', Carbon::parse($request->date_from))->whereDate('created_at', '<=', Carbon::parse($request->date_to));

        }

        if ($request->has('search') && !is_null($request->search) && $request->search !== '') {
            
            $quote->where('quote_id', 'LIKE', '%'.request()->search.'%')

           ->orWhereHas('customer_detail', function ($query)
            
           // $quote->whereHas('customer_detail', function ($query)
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
        // if (!is_null($request->q)) {
        //     $quote = $quote->whereHas('customer_detail', function ($query) use ($request) {
        //         return $query->where('customer_name', 'LIKE', '%'.$request->q.'%')->orWhere('technician', 'LIKE', '%'.$request->q.'%');
        //     });
        // }

        return response()->json([
            'response_code' => 200,
            'data' => $quote->paginate(4),
        ]);
        // return new QuotationCollection($quote->paginate(4));
    }

    public function store(Request $request)
    {
        $data = json_decode($request->data, true);
        // validations
        // $validator1 = Validator::make($data, [
        //     'customer_details.customer_name' => 'required',
        //     'customer_details.contact_number' => 'required',
        //     'customer_details.address' => 'required',
        //     'customer_details.email' => 'required',
        //     'customer_details.technician' => 'required',
        //     'customer_details.estimator' => 'required',
        //     'additional_values.details' => 'required',
        //     'discounts.percent_discount' => 'required',
        // ]);

        // if ($validator1->fails()) {
        //     return response()->json([
        //         'response_code' => 422,
        //         'message' => 'The given data was invalid.',
        //         'errors' => $validator1->errors()
        //     ], 422);
        // }

        // $images['assessed_damage'][] = $request['assessed_damage'];
        // $images['pre_existing_condition'][] = $request['pre_existing_condition'];

        // $validator2 = Validator::make($request->all(), [
        //     'assessed_damage' => 'array',
        //     'assessed_damage.*' => 'image|max:2048',
        //     'pre_existing_condition' => 'array',
        //     'pre_existing_condition.*' => 'image|max:2048'
        // ]);

        // if ($validator2->fails()) {
        //     return response()->json([
        //         'response_code' => 422,
        //         'message' => 'Invalid image or the image size should be less than 2MB',
        //         'errors' => $validator2->errors()
        //     ], 422);
        // }

        DB::beginTransaction();

        $customerDetails = $data['customer_details'];
        $customerDetails['user_id'] = auth()->user()->id;

        $vehicleDetails = $data['vehicle_details'];
        $vehicleDetails['state_id'] = $data['vehicle_details']['state'] ? State::whereStateCode($data['vehicle_details']['state'])->first()->id : null;

        $quote = new Quote();

        $quote->added_by = auth()->user()->id;
        $quote->quote_id = Carbon::now()->format('Uu_').$request->reg;
        $quote->attach_images_in_email = $data['images']['attach_images_in_email'];
        $quote->image_notes = $data['images']['image_notes'];

        $quote->save();

        $quote->customer_detail()->create($customerDetails);
        $quote->vehicle_detail()->create($vehicleDetails);

        $assessedDamage = 0;
        $preExistingCondition = 0;

        // if (Arr::has($request->all(), 'assessed_damage')) {
        //     foreach ($request['assessed_damage'] as $image) {
        //         $path = $image->store('public/user-uploads/quotation-images/'.$quote->id);
        //         $image_size = Storage::size($path);
        //         $quote->images()->create([
        //             'image_url' => $image->hashName(),
        //             'image_size' => $image_size,
        //             'image_type' => 'assessed_damage'
        //         ]);
        //     }
        // }
        while($request->has('assessed_damage'.$assessedDamage)) {
             $path = public_path('/user-uploads/quotation-images/'.$quote->id);
            // $path = $request['assessed_damage'.$assessedDamage]->store('public/user-uploads/quotation-images/'.$quote->id);
            
            $request['assessed_damage'.$assessedDamage]->move($path,$request['assessed_damage'.$assessedDamage]->getClientOriginalName());
            $image_size = filesize($path.'/'.$request['assessed_damage'.$assessedDamage]->getClientOriginalName());
            
            // $image_size = Storage::size($path);
            $quote->images()->create([
                'image_url' => $request['assessed_damage'.$assessedDamage]->getClientOriginalName(),
                'image_size' => $image_size,
                'image_type' => 'assessed_damage'
            ]);
            $assessedDamage++;
        }
        // if (Arr::has($request->all(), 'pre_existing_condition')) {
        //     foreach ($request['pre_existing_condition'] as $image) {
        //         $path = $image->store('public/user-uploads/quotation-images/'.$quote->id);
        //         $image_size = Storage::size($path);
        //         $quote->images()->create([
        //             'image_url' => $image->hashName(),
        //             'image_size' => $image_size,
        //             'image_type' => 'pre_existing_condition'
        //         ]);
        //     }
        // }
        while($request->has('pre_existing_condition'.$preExistingCondition)) {
            
            $path = public_path('/user-uploads/quotation-images/'.$quote->id);
            
         $request['pre_existing_condition'.$preExistingCondition]->move($path,$request['pre_existing_condition'.$preExistingCondition]->getClientOriginalName());
            $image_size = filesize($path.'/'.$request['pre_existing_condition'.$preExistingCondition]->getClientOriginalName());
            // $path = $request['pre_existing_condition'.$preExistingCondition]->store('public/user-uploads/quotation-images/'.$quote->id);
            // $image_size = Storage::size($path);
            $quote->images()->create([
                'image_url' => $request['pre_existing_condition'.$preExistingCondition]->getClientOriginalName(),
                'image_size' => $image_size,
                'image_type' => 'pre_existing_condition'
            ]);
            $preExistingCondition++;
        }
        $preconIds = [];

        foreach ($data['images']['precon'] as $precon) {
            $preconIds[] = $precon['precon_id'];
        }

        $quote->pre_existing_conditions()->sync($preconIds);

        // damaged areas
        foreach($data['damaged_areas'] as $area) {
            $guardIds = [];
            $addArea = false;

            if ($area['area_id'] == 0) {
                $damagedArea = $quote->custom_damaged_areas()->create([
                    'added_by' => auth()->user()->id,
                    'panel_area_name' => $area['panel_area_name'],
                    'position' => $area['position']
                ]);
            }

            foreach ($area['guards'] as $guard) {
                if ($guard['cost'] > 0) {
                    $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['cost']]);
                    $addArea = true;
                }
            }

            if ($addArea) {
                $quote->damaged_areas()->attach($area['area_id'] == 0 ? $damagedArea->id : $area['area_id']);
            }
            DamagedArea::whereId($area['area_id'] == 0 ? $damagedArea->id : $area['area_id'])->first()->guards()->sync($guardIds);
        }
        // foreach($data['damaged_areas'] as $area) {
        //     $guardIds = [];
        //     $addArea = false;

        //     foreach ($area['guards'] as $guard) {
        //         if ($guard['cost'] > 0) {
        //             $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['cost']]);
        //             $addArea = true;
        //         }
        //         if ($addArea) {
        //             $quote->damaged_areas()->attach($area['area_id']);
        //         }
        //     }
        //     DamagedArea::whereId($area['area_id'])->first()->guards()->sync($guardIds);
        // }

        // parts
        $partIds = [];
        foreach($data['parts'] as $part) {
            if ($part['part_id'] == 0) {
                $custom_part = $quote->custom_parts()->create([
                    'added_by' => auth()->user()->id,
                    'part_name' => $part['part_name'],
                    'position' => $part['position']
                ]);
                $partIds = Arr::add($partIds, $custom_part->id, ['part_quantity' => $part['quantity'], 'part_total' => $part['totalPrice']]);
            }else {
                $partIds = Arr::add($partIds, $part['part_id'], ['part_quantity' => $part['quantity'], 'part_total' => $part['totalPrice']]);
            }
        }
        $quote->parts()->sync($partIds);

        // additional values
        $quote->additional_value()->create($data['additional_values']);

        // discount
        $quote->discount()->create($data['discounts']);

        $notification = new Notification();
        $notification->quote_id = $quote->id;
        $notification->user_id = auth()->user()->id;
        $notification->to_email = $quote->customer_detail->send_email_to_customer ? $quote->customer_detail->email : auth()->user()->email;
        $notification->name = $quote->quote_id;
        $notification->type = 'quote';

        $notification->save();

        DB::commit();

        return response()->json([
            'response_code' => 200,
            'message' => 'Quotation generated successfully.',
            'data' => [
                'quote_id' => $quote->id
            ]
        ]);
    }

    public function checkVehicleReg(Request $request)
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
        // $registration = 'XXXXXXXXXXXXXXXXX';

        // check if car is stolen
        if ($request->type == 0) {
             $carData = $request->all();
            // $stolenData = '{"query":"query {\n  nevdisPlateSearch(plate: \"'.$registration.'\" , state: '.$request->state.'  ) {\n    vin\n  plate {\n  number\n state\n  }\n stolen{\n type\n }\n }\n}"}';
            // $carData = '{"query":"query {\n  nevdisPlateSearch(plate: \"'.$registration.'\" , state: '.$request->state.'  ) {\n    vin\n  plate {\n  number\n state\n    }\n    make\n    model\n colour\n chassis\n year_of_manufacture\n vehicle_type\n   compliance_plate\n engine_number\n vehicle_type\n    body_type\n   registration {\n status\n expiry_date\n }\n   wov {\n type_code\n jurisdiction\n damage_codes\n incident_recorded_date\n incident_code\n }\n   factory{\n    make\n    model\n    series\n    variant\n    buildYear\n    MY\n    body\n    fuel\n    drive\n    cylinders\n    litres\n    transmission\n  }\n  }\n}"}';
        }else {
             $carData = $request->all();
            
            // $stolenData = '{"query":"query {\n  nevdisVINSearch_v2(vin: \"'.$registration.'\"  ) {\n    vin\n  plate {\n  number\n state\n  }\n stolen{\n type\n }\n }\n}"}';
            // $carData = '{"query":"query {\n  nevdisVINSearch_v2(vin: \"'.$registration.'\"  ) {\n    vin\n  plate {\n  number\n state\n    }\n    make\n    model\n colour\n chassis\n year_of_manufacture\n vehicle_type\n   compliance_plate\n engine_number\n vehicle_type\n    body_type\n   registration {\n status\n expiry_date\n }\n   wov {\n type_code\n jurisdiction\n damage_codes\n incident_recorded_date\n incident_code\n }\n   factory{\n    make\n    model\n    series\n    variant\n    buildYear\n    MY\n    body\n    fuel\n    drive\n    cylinders\n    litres\n    transmission\n  }\n  }\n}"}';
        }

        $check = $this->getCarDataApi($carData);
        $data = json_decode($check, true);
        $res = [];

        if ($request->type == '1') {
            $res=$this->getCarDataApi($carData);
            $res = json_decode($res, true);
            // $res = $res['data']['nevdisVINSearch_v2'][0];
            // if($data['data']['nevdisVINSearch_v2'][0]['stolen']==NULL){
            //     $res['stolen']='';
            // }else{
            //     $res['stolen']='yes';
            // }
        } else {
            $res=$this->getCarDataApi($carData);
            $res = json_decode($res, true);
            // $res = $res['data']['nevdisPlateSearch'];
            // if($data['data']['nevdisPlateSearch']['stolen']==NULL){
            //     $res['stolen']='';
            // }else{
            //     $res['stolen']='yes';
            // }
        }
       
         
         $testdate = '{
    "request_id": "dde609fc-5cdc-4c26-9a10-757191045b83",
    "result": [
        {
            "vin": "JMFLYV78W5J003525",
            "chassis": null,
            "registration": {
                "plate": "TVJ435",
                "state": "VIC"
            },
            "make": "MITSUB",
            "model": "PAJERO",
            "colour": "SILVER OR CHROME",
            "body_type": "CAR/STATION WAGON",
            "vehicle_type": "CAR / SMALL PASSENGER VEHICLE",
            "engine_number": "4M41GT6982",
            "compliance_plate": "2005-04",
            "year_of_manufacture": "2005"
        }
    ]
}';
       
         $testing =   json_decode($testdate);
       
       
       
       
       
        return response()->json([
            'response_code' => 200,
            'data' => $testing
        ]);
    }

    public function getCarDataApi($postData)
    {
        
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

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        // $accesstoken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJmYTE1YjI5ZC02YzNhLTRkNGEtOWU3ZC1lZmI4MWFmZjExMzIiLCJuYW1lIjoiRGVudGZpeCBQdHkgTHRkIiwiaWF0IjoxNTE2MjM5MDIyLCJ2ZXJzaW9uIjoyfQ.4KaKG69gVpfVtuna8-bqwVYvT53ws4gUtVC2HcUOfYE';

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://ubuxgyols2.execute-api.ap-southeast-2.amazonaws.com/prod/');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);

        // curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        // $headers = array();
        // $headers[] = 'Content-Type: application/json';
        // $headers[] ='Access-Control-Allow-Headers: *';
        // $headers[]= 'Authorization: JWT '.$accesstoken;
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $result = curl_exec($ch);

        // $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if (curl_errno($ch)) {
        //     return 'Error:' . curl_error($ch);
        //     curl_close($ch);
        // }else{
        //     curl_close($ch);
        //     return $result;
        // }
    }

    public function getStates()
    {
        $states = State::select('id', 'state_name', 'state_code')->orderBy('state_name')->get();

        return response()->json([
            'response_code' => 200,
            'data' => $states
        ]);
    }

    public function addCustomDamagedArea(Request $request)
    {
        // validations
        $validator = Validator::make($request->all(), [
            'panel_area_name' => 'required',
            'position' => 'required|in:left,right'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $damagedArea = new DamagedArea();

        $damagedArea->added_by = auth()->user()->id;
        $damagedArea->panel_area_name = $request->panel_area_name;
        $damagedArea->position = $request->position;

        $damagedArea->save();

        return response()->json([
            'response_code' => 200,
            'data' => $damagedArea
        ]);
    }

    public function addCustomPart(Request $request)
    {
        // validations
        $validator = Validator::make($request->all(), [
            'part_name' => 'required',
            'position' => 'required|in:left,right,none',
            'unit_price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $part = new Part();

        $part->added_by = auth()->user()->id;
        $part->part_name = $request->part_name;
        $part->position = $request->position;
        $part->unit_price = $request->unit_price;

        $part->save();

        return response()->json([
            'response_code' => 200,
            'data' => $part
        ]);
    }

    public function getDamagedAreas()
    {
        $damagedAreas = DamagedArea::orderBy('panel_area_name')->whereNull('quote_id')->get();

        return response()->json([
            'response_code' => 200,
            'data' => $damagedAreas
        ]);
    }

    public function getParts()
    {
        $parts = Part::whereNull('quote_id')->get();

        return response()->json([
            'response_code' => 200,
            'data' => $parts
        ]);
    }

    public function getSummaryData($id)
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
        ])->where('id', $id)->first();

        $companyDetail = User::select('id');
        if (auth()->user()) {
            $companyDetail = $companyDetail->whereId(auth()->user()->id);
        }
        $companyDetail = $companyDetail->with('company_detail')->first()->company_detail;
        
      $created_attttt  = $quote->customer_detail->created_at->timezone($companyDetail->timezone);
      
         $created_qoute_date = Carbon::parse($created_attttt)->format('Y-m-d H:i:s');
        $quote->damaged_areas->map(function($area) {
            $area->guards->map(function($guard) {
                $this->damagedAreasTotal += $guard->pivot->panel_cost;
            });
        });

        $quote->parts->map(function($part) {
            $this->partsTotal += $part->pivot->part_total;
        });
        $partsTotal = $this->partsTotal;

        // $subTotal = $this->damagedAreasTotal + $this->partsTotal;
        $subTotal = $this->damagedAreasTotal;

        $discountPrice = $quote->discount ? ($quote->discount->percent_discount * $subTotal)/100 : 0;

        $gstPrice = $companyDetail && $companyDetail->check_gst ? ($companyDetail->gst * ($subTotal + $partsTotal - $discountPrice))/100 : 0;

        $total = $subTotal - $discountPrice + $partsTotal + $gstPrice;

        $email = $quote->customer_detail->email ?? $companyDetail->email;
        $name = $quote->customer_detail->customer_name ?? $companyDetail->company_name;
        if(is_null($quote->vehicle_detail->reg_number) || $quote->vehicle_detail->reg_number == ''){
            $akl = $quote->quote_id;
        }else{
           $akl =  $quote->vehicle_detail->reg_number;
            
        }
 
        $template = $companyDetail->email_template;
        $template = str_replace('{NAME}', $name, $template);
        $template = str_replace('{EMAIL}', $email, $template);
        $template = str_replace('{REGISTRATION}', $akl, $template);
        $template = str_replace('{YEAR}', $quote->vehicle_detail->year_of_manufacture, $template);
        $template = str_replace('{MAKE}', $quote->vehicle_detail->make, $template);
        $template = str_replace('{MODEL}', $quote->vehicle_detail->model, $template);
        $template = str_replace('{DATATIME}', $quote->created_at, $template);
        $template = str_replace("{ADMIN_URL}", url('/'),$template);
        $template = str_replace("{QUOTEID}",base64_encode($quote->id),$template);

        return response()->json([
            'response_code' => 200,
            'data' => [
                'quote' => $quote,
                'company_detail' => $companyDetail,
                'partsTotal' => number_format($partsTotal, 2),
                'subTotal' => number_format($subTotal, 2),
                'discountPrice' => number_format($discountPrice, 2),
                'subTotalIncludingParts' => number_format($subTotal+$partsTotal-$discountPrice, 2),
                'gstPrice' => number_format($gstPrice, 2),
                'total' => number_format($total, 2),
                'template' => $template,
                'created_at_qoute' => $created_qoute_date
            ]
        ]);
    }

    public function approveSummary(Request $request)
    {
        // validations
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email_temp' => 'required',
            'emails_multi' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        // Send email to customer or admin based on admin preference
        $quote = Quote::whereId($request->id)->with(['customer_detail', 'vehicle_detail'])->first();
        $quote->quote_status = 'submitted';
        $quote->save();

        $data = [];

        $data['template'] = $request->email_temp;

        foreach (explode(', ', $request->emails_multi) as $email) {
            $template = str_replace('{EMAIL}', $email, $data['template']);
            $data['template'] = $template;
            $data['email'] = $email;
            $data['subject'] = auth()->user()->company_detail->email_subject;
            $data['name'] = 'Customer';
            FacadesNotification::route('mail', $email)->notify(new SendMailAttachment($quote, $data));
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
        DB::commit();

        return response()->json([
            'response_code' => 200,
            'message' => 'Email sent successfully.',
            'data' => []
        ]);
    }

    public function getPrintSummary($encodedId)
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
        ])->where('id', $encodedId)->first();

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
        // dd(auth()->user());
        $user = User::whereId(1)->with('company_detail')->first();
        // dd($user);

        $view = view('pages.quotation.print_summary', compact('quote', 'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'leftParts', 'rightParts', 'partsTotal','user'))->render();

        return response()->json([
            'response_code' => 200,
            'data' => $view
        ]);
        // $pdf = new Pdf($view);
        // // if (!$pdf->send()) {
        // //     $error = $pdf->getError();
        // // }

        // return $pdf->send('test.pdf');

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('pages.quotation.print_summary', compact('quote', 'companyDetail', 'subTotal', 'discountPrice', 'gstPrice', 'total', 'damagedAreas', 'leftDamagedAreas', 'rightDamagedAreas', 'parts', 'leftParts', 'rightParts', 'partsTotal'))->save('user-uploads/pdf/'.$quote->id.'.pdf');

        // return $pdf->stream('string.pdf');

        // $pdf = file_get_contents(public_path('user-uploads/pdf/'.$quote->id.'.pdf'));
        // $encodedFile = base64_encode($pdf);

        // return response()->json([
        //     'response_code' => 200,
        //     'data' => $pdf->stream('hello.pdf')
        // ]);
    }

    public function destroyQuotation($id)
    {
        $quote = Quote::whereId($id)->first();
        if ($quote) {
            $quote->delete();

            return response()->json([
                'response_code' => 200,
                'message' => 'Quote deleted successfully.'
            ]);
        }
        return response()->json([
            'response_code' => 404,
            'message' => 'Quotation not found.'
        ]);
    }

    public function editQuotation($id)
    {
        $data = [];

        $data['cannedComments'] = CannedComment::select('id', 'title', 'comment')->get();
        $data['damagedAreas'] = DamagedArea::select('id', 'added_by', 'panel_area_name', 'position')->whereNull('quote_id')->with(['guards'])->get();
        $data['leftParts'] = Part::where('position', 'left')->whereNull('quote_id')->get();
        $data['rightParts'] = Part::where('position', 'right')->whereNull('quote_id')->get();
        $data['noneParts'] = Part::where('position', 'none')->whereNull('quote_id')->get();
        $data['states'] = State::all();
        $data['preExistingConditions'] = PreExistingCondition::orderBy('name')->get();
        $data['company_detail'] = CompanyDetail::first();

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
            'pre_existing_conditions'
        ])->where('id', $id)->first();

        $data['leftCustomParts'] = $data['quote']->custom_parts()->wherePosition('left')->get();
        $data['rightCustomParts'] = $data['quote']->custom_parts()->wherePosition('right')->get();
        $data['noneCustomParts'] = $data['quote']->custom_parts()->wherePosition('none')->get();

        $data['customDamagedAreas'] = $data['quote']->custom_damaged_areas()->with(['guards', 'quotes'])->get();

        return response()->json([
            'response_code' => 200,
            'data' => $data
        ]);
    }

    public function updateQuotation(Request $request, $id)
    {
        
      
        $data = json_decode($request->data, true);
        // validations
        // $validator1 = Validator::make($data, [
        //     'customer_details.customer_name' => 'required',
        //     'customer_details.contact_number' => 'required',
        //     'customer_details.address' => 'required',
        //     'customer_details.email' => 'required',
        //     'customer_details.technician' => 'required',
        //     'customer_details.estimator' => 'required',
        //     'additional_values.details' => 'required',
        //     'discounts.percent_discount' => 'required',
        // ]);

        // if ($validator1->fails()) {
        //     return response()->json([
        //         'response_code' => 422,
        //         'message' => 'The given data was invalid.',
        //         'errors' => $validator1->errors()
        //     ], 422);
        // }

        // $images['assessed_damage'][] = $request['assessed_damage'];
        // $images['pre_existing_condition'][] = $request['pre_existing_condition'];

        // $validator2 = Validator::make($request->all(), [
        //     'assessed_damage' => 'array',
        //     'assessed_damage.*' => 'image|max:2048',
        //     'pre_existing_condition' => 'array',
        //     'pre_existing_condition.*' => 'image|max:2048'
        // ]);

        // if ($validator2->fails()) {
        //     return response()->json([
        //         'response_code' => 422,
        //         'message' => 'Invalid image or the image size should be less than 2MB',
        //         'errors' => $validator2->errors()
        //     ], 422);
        // }

        DB::beginTransaction();
                
        $customerDetails = $data['customer_details'];
        $customerDetails['user_id'] = auth()->user()->id;

        $vehicleDetails = $data['vehicle_details'];
        $vehicleDetails['state_id'] = $data['vehicle_details']['state'] ? State::whereStateCode($data['vehicle_details']['state'])->first()->id : null;

        $quote = Quote::whereId($id)->first();
        $quote->quote_status = 'draft';
        $quote->added_by = auth()->user()->id;
        // $quote->quote_id = Carbon::now()->format('Uu_').$request->reg;
        $quote->attach_images_in_email = $data['images']['attach_images_in_email'];
        $quote->image_notes = $data['images']['image_notes'];

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

        // $assessedImages = is_null(json_decode($request->assessed_damage, true)) ? [] : json_decode($request->assessed_damage, true);
        // $preImages = is_null(json_decode($request->pre_existing_condition, true)) ? [] : json_decode($request->pre_existing_condition, true);

        // $assessedImagesArr = $quote->assessed_images->pluck('id')->toArray();
        // $preImagesArr = $quote->pec_images->pluck('id')->toArray();
        // $filteredAssessedImages = array_filter($assessedImagesArr, function ($assessedImage) use ($assessedImages) {
        //     return !in_array($assessedImage, $assessedImages);
        // });
        // $filteredPreImages = array_filter($preImagesArr, function ($preImage) use ($preImages) {
        //     return !in_array($preImage, $preImages);
        // });
        
         

        // $path = public_path('/user-uploads/quotation-images/'.$quote->id);

        // foreach ($filteredAssessedImages as $image) {
        //     $imageModel = $quote->assessed_images()->whereId($image)->first();
        //     Storage::delete($path.'/'.$imageModel->getRawOriginal('image_url'));
        //     $imageModel->delete();
        // }

        // foreach ($filteredPreImages as $image) {
        //     $imageModel = $quote->pec_images()->whereId($image)->first();
        //     Storage::delete($path.'/'.$imageModel->getRawOriginal('image_url'));
        //     $imageModel->delete();
        // }
        
              
              
            //   dd($request->assessed_damage,$data['assessed_damage']);
         $assessedImages = is_null($data['assessed_damage']) ? [] : $data['assessed_damage'];
        $preImages = is_null($data['pre_existing_condition']) ? [] : $data['pre_existing_condition'];
        
        // return $assessedImages;
        
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
        
        
        

        $assessedDamage = 0;
        $preExistingCondition = 0;




        // if (Arr::has($request->images, 'assessed_damage')) {
        //     foreach ($request->images['assessed_damage'] as $image) {
        //         $path = public_path('/user-uploads/quotation-images/'.$quote->id);
                
        //       $image->move($path,$image->getClientOriginalName());

        //         $image_size = filesize($path.'/'.$image->getClientOriginalName());
        //         $quote->images()->create([
        //             'image_url' => $image->getClientOriginalName(),
        //             'image_size' => $image_size,
        //             'image_type' => 'assessed_damage'
        //         ]);
        //     }
        // }
        
        
        // if (Arr::has($request->images, 'pre_existing_condition')) {

        //     foreach ($request->images['pre_existing_condition'] as $image) {
        //         $path = public_path('/user-uploads/quotation-images/'.$quote->id);
            
                
        //         $image->move($path,$image->getClientOriginalName());
        //         $image_size = filesize($path.'/'.$image->getClientOriginalName());
        //         $quote->images()->create([
        //             'image_url' => $image->getClientOriginalName(),
        //             'image_size' => $image_size,
        //             'image_type' => 'pre_existing_condition'
        //         ]);
        //     }
        // }
        
        
        
        while($request->has('assessed_damage'.$assessedDamage)) {
            $path = public_path('/user-uploads/quotation-images/'.$quote->id);
             $request['assessed_damage'.$assessedDamage]->move($path,$request['assessed_damage'.$assessedDamage]->getClientOriginalName());
            $image_size = filesize($path.'/'.$request['assessed_damage'.$assessedDamage]->getClientOriginalName());
            
            
            $quote->images()->create([
                'image_url' => $request['assessed_damage'.$assessedDamage]->getClientOriginalName(),
                'image_size' => $image_size,
                'image_type' => 'assessed_damage'
            ]);
            $assessedDamage++;
        }
      
        while($request->has('pre_existing_condition'.$preExistingCondition)) {
             $path = public_path('/user-uploads/quotation-images/'.$quote->id);
             
             
              $request['pre_existing_condition'.$preExistingCondition]->move($path,$request['pre_existing_condition'.$preExistingCondition]->getClientOriginalName());
            $image_size = filesize($path.'/'.$request['pre_existing_condition'.$preExistingCondition]->getClientOriginalName());
            
             
            // $path = $request['pre_existing_condition'.$preExistingCondition]->store('public/user-uploads/quotation-images/'.$quote->id);
            // $image_size = Storage::size($path);
            $quote->images()->create([
                'image_url' => $request['pre_existing_condition'.$preExistingCondition]->getClientOriginalName(),
                'image_size' => $image_size,
                'image_type' => 'pre_existing_condition'
            ]);
            $preExistingCondition++;
        }
        $preconIds = [];

        foreach ($data['images']['precon'] as $precon) {
            $preconIds[] = $precon['precon_id'];
        }

        $quote->pre_existing_conditions()->sync($preconIds);

        // damaged areas
        $areaIds = [];
        foreach($data['damaged_areas'] as $area) {
            $guardIds = [];
            $addArea = false;

            if ($area['area_id'] == 0) {
                $damagedArea = $quote->custom_damaged_areas()->create([
                    'added_by' => auth()->user()->id,
                    'panel_area_name' => $area['panel_area_name'],
                    'position' => $area['position']
                ]);
            }

            foreach ($area['guards'] as $guard) {
                if ($guard['cost'] > 0) {
                    $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['cost']]);
                    $addArea = true;
                }
            }
            if ($addArea) {
                if ($area['area_id'] == 0) {
                    $areaIds[] = $damagedArea->id;
                }else {
                    $areaIds[] = $area['area_id'];
                }
            }
            DamagedArea::whereId($area['area_id'] == 0 ? $damagedArea->id : $area['area_id'])->first()->guards()->sync($guardIds);
        }

        $quote->damaged_areas()->sync($areaIds);
        // foreach($data['damaged_areas'] as $area) {
        //     $guardIds = [];
        //     $addArea = false;

        //     foreach ($area['guards'] as $guard) {
        //         if ($guard['cost'] > 0) {
        //             $guardIds = Arr::add($guardIds, $guard['guard_id'], ['panel_cost' => $guard['cost']]);
        //             $addArea = true;
        //         }
        //         if ($addArea) {
        //             $quote->damaged_areas()->attach($area['area_id']);
        //         }
        //     }
        //     DamagedArea::whereId($area['area_id'])->first()->guards()->sync($guardIds);
        // }

        // parts
        $partIds = [];
        foreach($data['parts'] as $part) {
            if ($part['part_id'] == 0) {
                $custom_part = $quote->custom_parts()->create([
                    'added_by' => auth()->user()->id,
                    'part_name' => $part['part_name'],
                    'position' => $part['position']
                ]);
                $partIds = Arr::add($partIds, $custom_part->id, ['part_quantity' => $part['quantity'], 'part_total' => $part['totalPrice']]);
            }else {
                $partIds = Arr::add($partIds, $part['part_id'], ['part_quantity' => $part['quantity'], 'part_total' => $part['totalPrice']]);
            }
        }
        $quote->parts()->sync($partIds);

        // additional values
        $quote->additional_value()->update($data['additional_values']);

        // discount
        $quote->discount()->update($data['discounts']);

        DB::commit();

        return response()->json([
            'response_code' => 200,
            'message' => 'Quotation updated successfully.',
            'data' => [
                'quote_id' => $quote->id
            ]
        ]);
    }

    public function editSummary(Request $request, $id)
    {
        $data = [];

        $data['quote'] = Quote::with([
            'customer_detail',
            'vehicle_detail',
            'images',
            'damaged_areas',
            'parts',
            'additional_value',
            'discount',
        ])->where('id', $id)->first();

        $data['user'] = User::select('id');
        if (auth()->user()) {
            $data['user'] = $data['user']->whereId(auth()->user()->id);
        }
        $data['company_detail'] = $data['user']->with('company_detail')->first()->company_detail;
        $damagedAreas = DamagedArea::all();
        $data['leftDamagedAreas'] = $damagedAreas->filter(function ($area) {
            return $area->position == 'left';
        });
        $data['rightDamagedAreas'] = $damagedAreas->filter(function ($area) {
            return $area->position == 'right';
        });

        $data['parts'] = Part::select('id', 'part_name')->get();

        $data['quote']->damaged_areas->map(function($area) {
            $area->guards->map(function($guard) {
                $this->damagedAreasTotal += $guard->pivot->panel_cost;
            });
        });

        $data['quote']->parts->map(function($part) {
            $this->partsTotal += $part->pivot->part_quantity * $part->unit_price;
        });

        // $subTotal = $this->damagedAreasTotal + $this->partsTotal;
        $data['subTotal'] = $this->damagedAreasTotal;

        $data['partsTotal'] = $this->partsTotal;

        $data['discountPrice'] = $data['quote']->discount ? ($data['quote']->discount->percent_discount * $data['subTotal'])/100 : 0;

        $data['gstPrice'] = $data['company_detail'] ? ($data['company_detail']->gst * ($data['subTotal'] + $data['partsTotal'] - $data['discountPrice']))/100 : 0;

        $data['total'] = $data['subTotal'] - $data['discountPrice'] + $data['partsTotal'] + $data['gstPrice'];

        $data['subTotalIncludingParts'] = $data['subTotal'] + $data['partsTotal'] - $data['discountPrice'];

        return response()->json([
            'response_code' => 200,
            'data' => $data
        ]);
    }

    public function updateSummary(Request $request, $id)
    {
        $customerDetails = [
            'customer_name' => $request->customer_name,
            'contact_number' => $request->contact_number,
            'technician' => $request->technician,
            'estimator' => $request->estimator
        ];
        $customerDetails['user_id'] = auth()->user()->id;

        $vehicleDetails = [
            'make' => $request->make,
            'model' => $request->model,
            'colour' => $request->colour,
            'vin_number' => $request->vin_number,
            'reg_number' => $request->reg_number,
            'insurance' => $request->insurance,
            'claim_number' => $request->claim_number,
            'sunroof' => $request->sunroof
        ];
        // $vehicleDetails['state_id'] = $request->vehicle_details['state'] ? State::whereStateCode($request->vehicle_details['state'])->first()->id : null;

        $quote = Quote::whereId($id)->first();

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
        if ($request->has('damaged_areas')) {
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
        }

        // parts
        if ($request->has('parts')) {
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
        }

        // additional values
        $quote->additional_value()->update([
            'remove_n_replace' => $request->remove_and_replace,
            'details' => $request->details
        ]);

        // discount
        $quote->discount()->update([
            'percent_discount' => $request->percent_discount
        ]);

        return response()->json([
            'response_code' => 200,
            'message' => 'Quotation summary updated successfully.',
            'data' => [
                'quote_id' => $quote->id
            ]
        ]);
    }

    public function getCustomersList(Request $request)
    {
        $customers = CustomerDetail::select('id', 'customer_name', 'contact_number', 'address', 'email', 'technician', 'estimator')->where('customer_name', '<>', '')->where('customer_name', 'LIKE', '%'.$request->term.'%')->get();

        return response()->json([
            'response_code' => 200,
            'message' => '',
            'data' => $customers
        ]);
    }

    public function getCustomerDetail(Request $request)
    {
        $customerDetail = CustomerDetail::where('id', $request->id)->whereUserId(auth()->user()->id)->orderBy('customer_name')->first();

        return response()->json([
            'response_code' => 200,
            'message' => '',
            'data' => $customerDetail
        ]);
    }
}
