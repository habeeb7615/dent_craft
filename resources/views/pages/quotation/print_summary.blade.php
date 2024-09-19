<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pdf-3</title>
</head>

<body>
    <div style="padding-bottom: 1px;background-color: #f4f5fa;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;">
        <!-- <h3
            style="text-align: center;font-size: 30px;background: #1e2836;color: #9fa39e;padding: 7px;width: 300px;border-radius: 10px;margin: auto;">
            Quote Summary</h3> -->
        <div style="margin: auto">
            <!-- logo images -->
            <div style="margin:15px auto 0; width: 95%;display: flex;flex-wrap: wrap;color: white; padding: 10px;background: #fff;margin-top: 35px; justify-content: space-around; ">
                <div style="display:flex; width: 20%; justify-content: flex-end;">
                    <img class="img-fluid" src="{{ $user->company_detail->company_image_url  }}" alt="" style="margin-right:10px;width: 120px;height: 120px;object-fit: contain;">
                </div>
               
<div style=" width: 45%;margin: 0px 5px 0 0 ; display: flex;">
    <div style="width: 100%;">
        <ul style="padding: 0;margin: 0;">
            <li style="display:flex;">
                <span style="width: 50%;color: #000;font-size: 13px;font-weight: 900;">Company Name :</span>
                <span style="width: 50%;color: #000;font-weight: 100;font-size: 12px;word-break: break-all;"> {{$companyDetail->company_name }}</span>
            </li>
            <li style="display:flex;">
                <span style="width: 50%; color: #000;font-size: 13px;font-weight: 900;">ABN :</span>
                <span style="width: 50%;color: #000; font-weight: 100;font-size: 12px; word-break: break-all;">{{ $companyDetail->abn }}</span>
            </li>
            <li style="display:flex;">
                <span style="width: 50%; color: #000;font-size: 13px;font-weight: 900;">Mobile Number:</span>
                <span style="width: 50%;color: #000; font-weight: 100;font-size: 12px;word-break: break-all; ">{{ $companyDetail->mobile_number }}</span>
            </li>
            <li style="display:flex;">
                <span style="width: 50%; color: #000;font-size: 13px;font-weight: 900;word-break: break-all;">Email Address :</span>
                <span style="width: 50%;color: #000; font-weight: 100;font-size: 12px;word-break: break-all; ">{{ $companyDetail->email}}
                </span>
            </li>
            <li style="display:flex;">
                <span style="width: 50%; color: #000;font-size: 13px;font-weight: 900;">Address:</span>
                <span style="width: 50%;color: #000; font-weight: 100;font-size: 12px; word-break: break-all;">{{ $companyDetail->po_box}}</span>
            </li>
        </ul>
    </div>


    <button type="button" style="float: right; position: absolute; right: 3%; top:1%;" onclick="javascript:window.print();">Print</button>
</div>

<div style=" width: 33%;display: flex;">
    <div style="width: 90%;">

        <ul style="padding: 0;margin: 0;">
            <li style="display:flex;">
                <span style="width: 45%;color: #000;font-size: 13px;font-weight: 900;">Quote ID :</span>
                <span style="width: 55%;color: #000;font-weight: 100;font-size: 12px;word-break: break-all;"> {{ $quote->quote_id }}</span>
            </li>
            <li style="display:flex;">
                <span style="width: 45%; color: #000;font-size: 13px;font-weight: 900;">Date:</span>
                <span style="width: 55%;color: #000; font-weight: 100;font-size: 12px;word-break: break-all;">{{ $quote->created_at }}</span>

            </li>
            <li style="display:flex;">
                <span style="width: 45%; color: #000;font-size: 13px;font-weight: 900;">Insurance:</span>
                <span style="width: 55%;color: #000; font-weight: 100;font-size: 12px;word-break: break-all; ">{{ $quote->vehicle_detail ? $quote->vehicle_detail->insurance : '--' }}</span>
            </li>
            <li style="display:flex;">
                <span style="width: 45%; color: #000;font-size: 13px;font-weight: 900;"> Claim No :</span>
                <span style="width: 55%;color: #000; font-weight: 100;font-size: 12px;word-break: break-all; ">{{ $quote->vehicle_detail ? $quote->vehicle_detail->claim_number : '--' }}
                </span>
            </li>
            <li style="display:flex;">
                <span style="width: 45%; color: #000;font-size: 13px;font-weight: 900;">Technician:</span>
                <span style="width: 55%;color: #000; font-weight: 100;font-size: 12px; word-break: break-all;">{{$quote->customer_detail->technician}}</span>
            </li>
        </ul>
    </div>



</div>
                <!-- <div style="width: 30%; display: flex;color:black;justify-content: flex-end;">
                    <div>
                        <h4 style="font-size: 13px;">Quote ID</h4>
                        <h5 style="font-size: 13px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                            {{ $quote->quote_id }}
                        </h5>
                    </div>
                </div> -->
            </div>

            <!-- table 1 -->
            <div style="margin:15px auto 0; width: 95%;display: flex;flex-wrap: wrap;background: #ffffff;padding: 10px;color: #000000;">
                <!-- 1 -->
                <div style="width: 100%;">
                <h5 style="line-height: 0; margin-bottom: 0;">Customer Details </h5>
                    <div style="float: left;height: 60px; width: 20%;">
                        <h4 style="font-size: 11px;color: #000000;">Customer Name</h4>
                        <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                            {{ $quote->customer_detail->customer_name }}
                        </h5>
                    </div>
                    <div style="height: 60px; width: 20%; float: left;">
                        <h4 style="font-size: 11px;color: #000000;">Contact Number</h4>
                        <h5 style="font-size: 11px;margin-top: -15px;inline-size: fit-content;word-break: break-word;font-weight: 100;">
                            {{ $quote->customer_detail->contact_number }}
                        </h5>
                    </div>
                </div>
                <div style="width:100%; height: 25px;">
                <h5 style="line-height: 0;">Vehicle Details </h5>
                </div>
             
                <!-- <div style=" height: 60px; width: 20%; float: left;">
                    <h4 style="font-size: 11px;">Quote ID</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->quote_id }}
                    </h5>
                </div> -->
                <!-- 2 -->
                <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Make</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->make : '--' }}
                    </h5>
                </div>

                <!-- 9 -->
                <!-- <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Insurance</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->insurance : '--' }}
                    </h5>
                </div> -->
                <!-- 3 -->

                <!-- 4 -->
                <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Model</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->model : '--' }}
                    </h5>
                </div>
                <!-- 5 -->


                <!-- 6 -->
                <!-- <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;"> Claim No
                    </h4>
                    <h5 style="font-size: 11px;margin-top: -15px;inline-size: fit-content;word-break: break-word;font-weight: 100;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->claim_number : '--' }}
                    </h5>
                </div> -->
                <!-- 7 -->
                <!-- <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Date</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->created_at }}
                    </h5>
                </div> -->
                <!-- 8 -->
                <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Reg. No

                    </h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->reg_number : '--' }}
                    </h5>
                </div>
               
                <!-- 9 -->
                <!-- <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Technician</h4>
                    <h5 style="font-size: 11px;margin-top: -15px;inline-size: fit-content;word-break: break-word;font-weight: 100;">
                        {{ $quote->customer_detail->technician }}
                    </h5>
                </div> -->
                
                <!-- 10 -->
                <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">VIN No</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->vin_number : '--' }}
                    </h5>
                </div>
                <!-- 8 -->
                <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Colour</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->colour : '--' }}
                    </h5>
                </div>
                <!-- 10 -->
                <div style="height: 60px; width: 20%;float: left;">
                    <h4 style="font-size: 11px;color: #000000;">Sunroof</h4>
                    <h5 style="font-size: 11px;font-weight: 100;margin-top: -15px;inline-size: fit-content;word-break: break-word;">
                        {{ $quote->vehicle_detail ? $quote->vehicle_detail->sunroof : '--' }}
                    </h5>
                </div>
            </div>


            @if (count($quote->damaged_areas) > 0)
            <!-- table 2 -->
            <div style="margin: 8px auto 0;
    width: 96.4%; 
    color: #000000;
    height: auto;
    display: flex;
">
                <div style="width: 49%;margin-right:13px; float:left">
                    <table style="border-collapse: collapse;width: 100%;background: #ffffff;color: rgb(0, 0, 0);font-size: 11px;">
                        <!-- table header -->
                        <thead>
                            <tr style="background: #9fa39e;text-align: left;color: black;">
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Damaged Area
                                </th>
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Quantity
                                </th>
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <!-- table body -->
                        <tbody>
                            @foreach ($leftDamagedAreas as $area)
                            <tr style="border-top: 2px solid #fff;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    <!-- {{ $area->panel_area_name }} -->
                                    {{ $area->panel_area_name }}
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    {{ count($area->guards) }}
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    {{ $area->guards()->sum('panel_cost') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="width: 50%; float:left">
                    @if (count($quote->damaged_areas) > 1)
                    <table style="border-collapse: collapse;width: 100%;border-radius: 10px;font-size: 11px;">
                        <!-- table header -->
                        <thead>
                            <tr style="background: #9fa39e;text-align: left;color: black;">
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Damaged Area
                                </th>
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Quantity
                                </th>
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <!-- table body -->
                        <tbody>
                            @foreach ($rightDamagedAreas as $area)
                            <tr style="border-top: 2px solid #fff;background: #ffffff;color: #000000;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    {{ $area->panel_area_name }}
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    {{ count($area->guards) }}
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    {{ $area->guards()->sum('panel_cost') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            @endif
            <div style="clear: both;"></div>
            <div style="margin: 8px auto 0; width: 96.4%;color: #000000;height: auto;display: flex;
">
                @if (count($quote->parts) > 0)
                <!-- table 3 -->
                <div style="width: 49%; margin-right:13px; float: left; ">
                    <table style="border-collapse: collapse;width: 100%;background: #ffffff;color: #000000;font-size: 11px;">
                        <!-- table header -->
                        <thead>
                            <tr style="background: #9fa39e;text-align: left;color: black;">
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Parts
                                </th>
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Quantity
                                </th>
                            </tr>
                        </thead>
                        <!-- table body -->
                        <tbody>
                            @foreach ($leftParts as $part)
                            <tr style="border-top: 2px solid #fff;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    
                                    {{ $part->part_name }}
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    {{ $part->pivot->part_quantity }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div style="width: 50%;float: right;">
                    <table style="border-collapse: collapse;width: 100%; font-size: 11px;">
                        <!-- table header -->
                        <thead>
                            <tr style="background: #9fa39e;text-align: left;color: #070303;">
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Estimate Breakdown
                                </th>
                                <th style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <!-- table body -->
                        <tbody>
                            <!--<tr style="background: #ffffff;color: black;">-->
                            <!--    <td style="padding: 0.25rem 0.50rem;vertical-align: top;">-->
                            <!--        R&amp;R (Remove and Replace)-->
                            <!--    </td>-->
                            <!--    <td style="padding: 0.25rem 0.50rem;vertical-align: top;">-->
                            <!--        {{ $quote->additional_value->remove_n_replace }}-->
                            <!--    </td>-->
                            <!--</tr>-->
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Parts
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($partsTotal, 2) }}
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    R&R(Remove and Replace)
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    <!--{{ $quote->additional_value->details }}-->
                                    {{ $quote->additional_value->remove_n_replace}}
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    SubTotal
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($subTotal, 2) }}
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Discount (0%)
                                    <!-- ({{ $quote->discount->percent_discount }}%) -->
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($discountPrice, 2) }}
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    SubTotal (Including Parts)
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($subTotal + $partsTotal - $discountPrice, 2) }}
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    GST
                                    ({{ $companyDetail && $companyDetail->check_gst ? $companyDetail->gst : 0 }}%)
                                </td>
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($gstPrice, 2) }}
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #1e2836;background: #ffffff;color: black;">
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    Total
                                </td>
                                @if(is_numeric($quote->additional_value->remove_n_replace))
                                <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($total, 2) + number_format($quote->additional_value->remove_n_replace,2) }}
                                </td>
                                @endif
                                 @if(!is_numeric($quote->additional_value->remove_n_replace))
                                   <td style="padding: 0.25rem 0.50rem;vertical-align: top;">
                                    ${{ number_format($total, 2)}}
                                </td>
                                  @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table 4 -->
                     
            <div style="margin: 10px 15px;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;">
                <!-- Notes -->
                
                <div style="width: 100%;">
                    <textarea rows="5" cols="2" placeholder="Notes" style="width: 100%; margin-top: 0px; margin-bottom: 0px;">{{$quote->image_notes }}</textarea>
                </div>
            </div>
            <div style="margin: 10px 15px;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;    margin-top: -20px;">
                <!-- Notes -->
               <div style="width:100%;">
                <h5 style="line-height: 0;">Remove and Replace</h5>
                 <textarea rows="5" cols="2" placeholder="Notes" style="width: 100%; margin-top: 0px; margin-bottom: 0px;">{{$quote->additional_value->details }} </textarea>
              
                </div>
               
            </div>
        </div>
    </div>
</body>

</html>