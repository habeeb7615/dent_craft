<x-guest-layout>

<?php if(!is_null($quote->deleted_at)){ ?>
    <div class="app-content content" >
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card " id="add-page">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-12 row">
                                <h3 class="content-header-title mb-0 d-inline-block">Sorry! the quote has been deleted</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="window-height" id="print-this">
        <div class="new-quotation-wrapper after-header-section common-padding-lr">
            <div class="latest-question-wrapper d-flex align-item-center justify-content-between">
                <h5>Pre Authorisation</h5>
                <a href="{{ route('admin.quotation.print_summary', base64_encode($quote->id)) }}" target="_blank" class="print-doc-link">
                    <img src="{{ asset('new-theme/images/printer.svg') }}" alt="" />
                    <span>Print</span>
                </a>
            </div>
            <div class="new-quotation-form">
                <div class="new-quotation-wrap">
                    <div class="car-authorisation-info-wrapper">
                        <div class="car-authorisation-info">
                            <ul>
                                <li>
                                    <span>Company:</span>
                                    <p>{{ $companyDetail->company_name }}</p>
                                </li>
                                <li>
                                    <span>ABN:</span>
                                    <p>{{ $companyDetail->abn }}</p>
                                </li>
                                <li>
                                    <span>Mobile Number:</span>
                                    <p>{{ $companyDetail->mobile_number }}</p>
                                </li>
                                <li>
                                    <span>Email Address:</span>
                                    <p>{{ $companyDetail->email }}</p>
                                </li>
                                <li>
                                    <span>Po Box:</span>
                                    <p>{{ $companyDetail->po_box }}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="car-authorisation-photos">
                            @foreach ($quote->images as $image)
                                <div class="car-photo">
                                    <figure class="car-photo-img" style="display: none;">
                                        <img src="{{ $image->image_url }}" alt="">
                                    </figure>
                                    <div class="placeholder-text">
                                        <img src="{{ $image->image_url }}" alt="">
                                        <p>{{ $image->image_type === 'assessed_damage' ? 'Assessed Damage' : 'Pre Existing Condition' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="new-quotation-wrap">
                    <div class="car-authorisation-info-2column">
                        <ul>
                            <li>
                                <span>Customer Name</span>
                                <p>{{ $quote->customer_detail->customer_name }}</p>
                            </li>
                            <li>
                                <span>Quote ID</span>
                                <p>{{ $quote->quote_id }}</p>
                            </li>
                            <li>
                                <span>Contact Number</span>
                                <p>{{ $quote->customer_detail->contact_number }}</p>
                            </li>
                            <li>
                                <span>Date</span>
                                <p>{{ $quote->customer_detail->created_at }}</p>
                            </li>
                            <li>
                                <span>Technician</span>
                                <p>{{ $quote->customer_detail->technician }}</p>
                            </li>
                            <li>
                                <span>Estimator</span>
                                <p>{{ $quote->customer_detail->estimator }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="new-quotation-wrap">
                    <div class="car-authorisation-info-2column">
                        <ul>
                            <li>
                                <span>Make</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->make : '--' }}</p>
                            </li>
                            <li>
                                <span>Insurance</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->insurance : '--' }}</p>
                            </li>
                            <li>
                                <span>Model</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->model : '--' }}</p>
                            </li>
                            <li>
                                <span>VIN No.</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->vin_number : '--' }}</p>
                            </li>
                            <li>
                                <span>Reg. No.</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->reg_number : '--' }}</p>
                            </li>
                            <li>
                                <span>Claim No.</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->claim_number : '--' }}</p>
                            </li>
                            <li>
                                <span>Colour</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->colour : '--' }}</p>
                            </li>
                            <li>
                                <span>Sunroof</span>
                                <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->sunroof : '--' }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                @if (count($quote->damaged_areas) > 0)
                    <div class="new-quotation-wrap damage-area-wrapper">
                        <div class="table-responsive">
                            <table class="mt-0">
                                <tr>
                                    <th>Damaged Area</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                                @foreach ($quote->damaged_areas as $area)
                                    <tr>
                                        <td>{{ $area->panel_area_name }}</td>
                                        <td>{{ count($area->guards) }}</td>
                                        <td>${{ $area->guards()->sum('panel_cost') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
                @if (count($quote->parts) > 0)
                    <div class="new-quotation-wrap damage-area-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="mt-0">
                                        <tr>
                                            <th>Parts</th>
                                            <th>Quantity</th>
                                        </tr>
                                        @foreach ($quote->parts as $part)
                                            <tr>
                                                <td>{{ $part->part_name }}</td>
                                                <td class="text-truncate text-center " colspan="2">
                                                    {{ $part->pivot->part_quantity }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="new-quotation-wrap damage-area-wrapper estimate-breakdown-table">
                    <h5>Estimate Breakdown</h5>
                    <div class="table-responsive">
                        <table class="mt-0">
                            <tr>
                                <th>Estimate Breakdown</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>Parts</td>
                                <td>${{ number_format($partsTotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Details</th>
                            </tr>
                            <tr>
                                <td>SubTotal</td>
                                <td>${{ number_format($subTotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Discount({{$quote->discount ? $quote->discount->percent_discount : 0}}%)</td>
                                <td>{{ number_format($discountPrice, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Subtotal (Including Parts)</td>
                                <td>${{ number_format($subTotal + $partsTotal - $discountPrice, 2) }}</td>
                            </tr>
                            <tr>
                                <td>GST({{$companyDetail ? $companyDetail->gst : 0}}%)</td>
                                <td>${{ number_format($gstPrice, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="estimae-total">
                        <h4>Total <span>${{ number_format($total, 2) }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</x-guest-layout>
