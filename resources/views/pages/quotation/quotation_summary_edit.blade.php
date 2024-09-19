<x-app-layout>
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
        <div class="page-content window-height" id="print-this">
            <div class="new-quotation-wrapper after-header-section common-padding-lr">
                <div class="latest-question-wrapper d-flex align-item-center justify-content-between">
                    <h5>Edit Quotation Summary</h5>
                    {{-- <a href="{{ route('admin.quotation.print_summary', base64_encode($quote->id)) }}" target="_blank" class="print-doc-link">
                        <img src="{{ asset('new-theme/images/printer.svg') }}" alt="" />
                        <span>Print</span>
                    </a> --}}
                </div>
                <div class="new-quotation-form">
                    <form id="edit-summary">
                        @csrf
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
                                        <input name="customer_details[customer_name]" type="text" class="form-control" value="{{ $quote->customer_detail->customer_name }}">
                                        {{-- <p>{{ $quote->customer_detail->customer_name }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Quote ID</span>
                                        <p>{{ $quote->quote_id }}</p>
                                    </li>
                                    <li>
                                        <span>Contact Number</span>
                                        <input name="customer_details[contact_number]" type="text" class="form-control" value="{{ $quote->customer_detail->contact_number }}">
                                        {{-- <p>{{ $quote->customer_detail->contact_number }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Date</span>
                                        <p>{{ $quote->customer_detail->created_at }}</p>
                                    </li>
                                    <li>
                                        <span>Technician</span>
                                        <input name="customer_details[technician]" type="text" class="form-control" value="{{ $quote->customer_detail->technician }}">
                                        {{-- <p>{{ $quote->customer_detail->technician }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Estimator</span>
                                        <input name="customer_details[estimator]" type="text" class="form-control" value="{{ $quote->customer_detail->estimator }}">
                                        {{-- <p>{{ $quote->customer_detail->estimator }}</p> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="new-quotation-wrap">
                            <div class="car-authorisation-info-2column">
                                <ul>
                                    <li>
                                        <span>Make</span>
                                        <input name="vehicle_details[make]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->make : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->make : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Insurance</span>
                                        <input name="vehicle_details[insurance]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->insurance : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->insurance : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Model</span>
                                        <input name="vehicle_details[model]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->model : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->model : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>VIN No.</span>
                                        <input name="vehicle_details[vin_number]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->vin_number : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->vin_number : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Reg. No.</span>
                                        <input name="vehicle_details[reg_number]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->reg_number : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->reg_number : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Claim No.</span>
                                        <input name="vehicle_details[claim_number]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->claim_number : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->claim_number : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Colour</span>
                                        <input name="vehicle_details[colour]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->colour : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->colour : '--' }}</p> --}}
                                    </li>
                                    <li>
                                        <span>Sunroof</span>
                                        <input name="vehicle_details[sunroof]" type="text" class="form-control" value="{{ $quote->vehicle_detail ? $quote->vehicle_detail->sunroof : '--' }}">
                                        {{-- <p>{{ $quote->vehicle_detail ? $quote->vehicle_detail->sunroof : '--' }}</p> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if (count($quote->damaged_areas) > 0)
                            <div class="new-quotation-wrap damage-area-wrapper">
                                <div class="table-responsive">
                                    <table class="mt-0">
                                        <tr>
                                            <th>Panel Area</th>
                                            <th>Panel Cost</th>
                                            <th>Additional</th>
                                        </tr>
                                        @foreach ($damagedAreas as $area)
                                            @include('pages.quotation.partials.damaged_area_edit', ['damagedArea' => $area, 'damagedAreasCount' => count($damagedAreas)])
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
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Unit Price</th>
                                                </tr>
                                                @foreach ($parts as $part)
                                                    <?php $quotePart = $quote->parts()->whereId($part->id)->first() ?>
                                                    <tr>
                                                        <td>{{ $part->part_name }}</td>
                                                        <td class="text-truncate text-center">
                                                            <input name="parts[{{$part->id}}][quantity]" type="text" class="form-control" value="{{ $quotePart ? $quotePart->pivot->part_quantity : '0' }}">
                                                        </td>
                                                        <td class="text-truncate text-center">
                                                            <input name="parts[{{$part->id}}][unit_price]" type="text" class="form-control" value="{{ $quotePart ? $quotePart->unit_price : '0' }}">
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
                                        <td>Remove & Repair</td>
                                        <td><input name="additional_values[remove_n_replace]" type="text" value="{{ $quote->additional_value->remove_n_replace }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Parts</td>
                                        <td>${{ number_format($partsTotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Details</td>
                                        <td><input name="additional_values[details]" type="text" value="{{ $quote->additional_value->details }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount %</td>
                                        <td><input name="discounts[percent_discount]" type="number" value="{{ $quote->discount->percent_discount }}"></td>
                                    </tr>
                                    <tr>
                                        <td>SubTotal</td>
                                        <td>${{ number_format($subTotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount({{$quote->discount ? $quote->discount->percent_discount : 0}}%)</td>
                                        <td>${{ number_format($discountPrice, 2) }}</td>
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
                        <div class="form-submit">
                            <button type="button" onclick="javascript:update_summary()" class="btn btn-primary">Update Summary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      <?php } ?>

    @push('scripts')
        <script>
            function update_summary() {
                var form = $('#edit-summary')
                $.ajax({
                    url: "{{ route('admin.quotation.update_summary', $quote->id) }}",
                    method: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.response_code == 200) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Quotation summary updated successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            
                            setTimeout(() => {
                                window.location.href = "{{ route('admin.dashboard') }}"
                            }, 1500)
                        }
                    }
                })
            }
        </script>
    @endpush
</x-app-layout>
