<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $quote = Quote::with(['customer_detail', 'assessed_images'])->orderBy('created_at', 'desc');
        if (!is_null($request->min) && !is_null($request->max)) {
            $quote->whereDate('created_at', '>=', Carbon::parse($request->min))->whereDate('created_at', '<=', Carbon::parse($request->max));
        }
        if ($request->has('search') && !is_null($request->search) && $request->search != '') {
            
           $quote->where('quote_id', 'LIKE', '%'.request()->search.'%')
            
          ->orWhereHas('customer_detail', function ($query)
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
        $quotes = $quote->paginate(4);
           
        return view('pages.dashboard', ['quotes' => $quotes]);
    }
}
