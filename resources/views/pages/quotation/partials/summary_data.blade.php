<div class="card-body p-0" style="font-size:20px !important;">
    <div class="col-md-12 row" style="font-size:18px;">
        <div class="col-md-1"></div>
        <div class="col-md-3 col-sm-6">
            <img src="{{ $data['companyDetail']->company_image_url }}" class="pe-img">
        </div>
        <div class="col-md-7 col-sm-6">
            <div class="row">
                <div class="col-md-3 col-sm-6"><label style="font-size:20px !important;"><strong>Company:</strong></label></div>
                <div class="col-md-9 col-sm-6"><label style="font-size:20px !important;">{{ $data['companyDetail']->company_name }}</label></div>
                <div class="col-md-3 col-sm-6"><label style="font-size:20px !important;"><strong>ABN:</strong></label></div>
                <div class="col-md-9 col-sm-6"><label style="font-size:20px !important;">{{ $data['companyDetail']->abn }}</label></div>
                <div class="col-md-3 col-sm-6"><label style="font-size:20px !important;"><strong>Mobile Number:</strong></label></div>
                <div class="col-md-9 col-sm-6"><label style="font-size:20px !important;">{{ $data['companyDetail']->mobile_number }}</label></div>
                <div class="col-md-3 col-sm-6"><label style="font-size:20px !important;"><strong>Email Address:</strong></label></div>
                <div class="col-md-9 col-sm-6"><label style="font-size:20px !important;">{{ $data['companyDetail']->email }}</label></div><div class="col-md-3 col-sm-6"><label style="font-size:20px !important;"><strong>Po Box:</strong></label></div>
                <div class="col-md-9 col-sm-6"><label style="font-size:20px !important;">{{ $data['companyDetail']->po_box }} </label></div>
            </div>
        </div>
         <div class="col-md-1"></div>
    </div>

     <form class="form"  id="formid"  >
        <div class="row mt-3">
            <div class="col-md-1"></div>
            <div class="col-md-10 p-0">

                          <div id="new-orders" class="media-list position-relative ps-container ps-theme-default" data-ps-id="6b4eb629-7102-f486-684d-2669bf318b2d">
                            <div class="table-responsive">
                              <table id="new-orders-table" class="table table-hover table-xl mb-0 summary-table qs-table">
                                <tbody>
                                  <tr class="table-bg-clr">
                                    <td class="text-truncate bt-0 text-center t-br" colspan="2">Quote ID</td>

                                    <td class="text-truncate bt-0 text-center"  colspan="2"> {{ $data['quote']->quote_id }}</td>

                                  </tr>
                                  <tr>
                                    <td class="text-truncate text-center t-br" colspan="2">Customer Name</td>

                                    <td class="text-truncate text-center " colspan="2">{{ $data['quote']->customer_detail->customer_name }}</td>
                                  </tr>
                                  <tr class="table-bg-clr">
                                    <td class="text-truncate text-center t-br" colspan="2">Customer Contact Number</td>

                                    <td class="text-truncate text-center" colspan="2">{{ $data['quote']->customer_detail->contact_number }}</td>
                                  </tr>
                                    <tr>
                                    <td class="text-truncate text-center t-br" colspan="2"> Date</td>

                                    <td class="text-truncate text-center" colspan="2">{{ $data['quote']->customer_detail->created_at->format('d-m-Y') }}</td>
                                  </tr>
                                    <tr class="table-bg-clr">
                                    <td class="text-truncate text-center t-br" colspan="2">Technician</td>
                                    <td class="text-truncate text-center" colspan="2">{{ $data['quote']->customer_detail->technician }}</td>
                                  </tr>
                                </tbody>
                              </table>
                                <table id="new-orders-table" class="table table-hover table-xl mb-0  qs-table mt-1">
                                <tbody>

                                  <tr class="table-bg-clr">
                                    <td class="text-truncate bt-0 text-center t-br">Make</td>
                                    <td class="text-truncate bt-0 text-center t-br" >{{ $data['quote']->vehicle_detail->make }}</td>
                                      <td class="text-truncate bt-0 text-center t-br">Insurance</td>
                                    <td class="text-truncate bt-0 text-center" >{{ $data['quote']->vehicle_detail->insurance }}</td>
                                  </tr>
                                  <tr>
                                    <td class="text-truncate text-center t-br">Model</td>

                                    <td class="text-truncate text-center t-br">{{ $data['quote']->vehicle_detail->model }}</td>
                                      <td class="text-truncate bt-0 text-center t-br">VIN No.</td>
                                    <td class="text-truncate bt-0 text-center" >{{ $data['quote']->vehicle_detail->vin_number }}</td>
                                  </tr>
                                  <tr class="table-bg-clr">
                                    <td class="text-truncate text-center t-br">Reg. No.</td>

                                    <td class="text-truncate text-center t-br">{{ $data['quote']->vehicle_detail->reg_number }}</td>
                                       <td class="text-truncate bt-0 text-center t-br">Claim No.</td>
                                    <td class="text-truncate bt-0 text-center" >{{ $data['quote']->vehicle_detail->claim_number }}</td>
                                  </tr>
                                    <tr >
                                    <td class="text-truncate text-center t-br">Colour</td>

                                    <td class="text-truncate text-center t-br">{{ $data['quote']->vehicle_detail->colour }}</td>
                                          <td class="text-truncate text-center t-br">Sunroof</td>
                                    <td class="text-truncate text-center">{{ $data['quote']->vehicle_detail->sunroof }}</td>
                                  </tr>
                                </tbody>
                              </table>
                                <div class="col-md-12 qs-table3">
                                  <div class="col-md-6 p-0  max-width-mb">
                                      <table id="new-orders-table" class="table table-hover table-xl mb-0  qs-table mt-1">
                                        <tbody>
                                          <tr class="table-bg-clr">
                                            <td class="text-truncate bt-0 text-center t-br">Damaged Area</td>
                                            <td class="text-truncate bt-0 text-center t-br" >Quantity</td>
                                            <td class="text-truncate bt-0 text-center" >Amount</td>
                                          </tr>
                                          @forelse ($data['leftDamagedAreas'] as $leftDamagedArea)
                                            <tr class="table-td-clr">
                                                <td class="text-truncate text-center t-br">{{ $leftDamagedArea->panel_area_name }}</td>
                                                @if (in_array($data['quote']->id, $leftDamagedArea->quotes()->pluck('id')->toArray()))
                                                    <td class="text-truncate text-center t-br">
                                                    {{ count($leftDamagedArea->guards) }}
                                                    </td>
                                                    <td class="text-truncate bt-0 text-center" >
                                                        {{ $leftDamagedArea->guards()->sum('panel_cost') }}
                                                    </td>
                                                @else
                                                    <td class="text-truncate text-center t-br">
                                                        0
                                                    </td>
                                                    <td class="text-truncate bt-0 text-center" >
                                                        0
                                                    </td>
                                                @endif
                                            </tr>
                                            @empty
                                            <tr class="table-td-clr">
                                                <td class="text-truncate text-center t-br" colspan="2">
                                                    No Damaged Areas added...
                                                </td>
                                            </tr>
                                          @endforelse
                                        </tbody>
                                      </table>
                                  </div>


                                     <div class="col-md-6 pr-0 padding-mb  max-width-mb">
                                      <table id="new-orders-table" class="table table-hover table-xl mb-0  qs-table mt-1">
                                        <tbody>
                                          <tr class="table-bg-clr">
                                            <td class="text-truncate bt-0 text-center t-br">Damaged Area </td>
                                            <td class="text-truncate bt-0 text-center t-br" >Quantity</td>
                                            <td class="text-truncate bt-0 text-center" >Amount</td>
                                          </tr>
                                          @forelse ($data['rightDamagedAreas'] as $rightDamagedArea)
                                            <tr class="table-td-clr">
                                                <td class="text-truncate text-center t-br">{{ $rightDamagedArea->panel_area_name }}</td>
                                                @if (in_array($data['quote']->id, $rightDamagedArea->quotes()->pluck('id')->toArray()))
                                                    <td class="text-truncate text-center t-br">
                                                    {{ count($rightDamagedArea->guards) }}
                                                    </td>
                                                    <td class="text-truncate bt-0 text-center" >
                                                        {{ $rightDamagedArea->guards()->sum('panel_cost') }}
                                                    </td>
                                                @else
                                                    <td class="text-truncate text-center t-br">
                                                        0
                                                    </td>
                                                    <td class="text-truncate bt-0 text-center" >
                                                        0
                                                    </td>
                                                @endif
                                            </tr>
                                            @empty
                                            <tr class="table-td-clr">
                                                <td class="text-truncate text-center t-br" colspan="2">
                                                    No Damaged Areas added...
                                                </td>
                                            </tr>
                                          @endforelse
                                        </tbody>
                                      </table>
                                  </div>


                                </div>

                                 <div class="col-md-12 qs-table3">
                                  <div class="col-md-6 p-0 max-width-mb">
                                      <table id="new-orders-table" class="table table-hover table-xl mb-0  qs-table mt-1">
                                        <tbody>
                                          <tr class="table-bg-clr">
                                    <td class="text-truncate bt-0 text-center t-br" colspan="2">Parts</td>

                                    <td class="text-truncate bt-0 text-center"  colspan="2">Quantity</td>

                                  </tr>

                                  @forelse($data['parts'] as $key => $part)
                                    <tr class="@if($key == 0) table-td-clr @endif">
                                        <td class="text-truncate text-center t-br" colspan="2"><?php  echo  $part->part_name ; ?></td>

                                        @if (!is_null($data['quote']->parts()->whereId($part->id)->first()))
                                        <td class="text-truncate text-center " colspan="2">
                                            {{ $data['quote']->parts()->whereId($part->id)->first()->pivot->part_quantity }}
                                        </td>
                                        @else
                                        <td class="text-truncate text-center " colspan="2">
                                            0
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                        <tr class="table-td-clr">
                                            <td class="text-truncate text-center t-br" colspan="2">
                                                No Parts added...
                                            </td>
                                        </tr>
                                    @endforelse

                                  <tr class="">
                                    <td class="text-truncate text-center t-br" colspan="2">&nbsp;</td>
                                    <td class="text-truncate text-center" colspan="2"></td>
                                  </tr>
                                  <tr class="">
                                    <td class="text-truncate text-center t-br" colspan="2">&nbsp;</td>
                                    <td class="text-truncate text-center" colspan="2"></td>
                                  </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                     <div class="col-md-6 pr-0 padding-mb max-width-mb">
                                      <table id="new-orders-table" class="table table-hover table-xl mb-0  qs-table mt-1">
                                        <tbody>
                                         <tr class="table-bg-clr">
                                    <td class="text-truncate bt-0 text-center t-br" colspan="2">Estimate Breakdown</td>

                                    <td class="text-truncate bt-0 text-center"  colspan="2">Amount</td>

                                  </tr>
                                  <tr class="table-td-clr">
                                    <td class="text-truncate text-center t-br" colspan="2">R&R (Remove & Replace)</td>

                                    <td class="text-truncate text-center " colspan="2">{{ $data['quote']->additional_value ? $data['quote']->additional_value->remove_and_replace : '--' }}</td>
                                  </tr>
                                  <tr>
                                    <td class="text-truncate text-center t-br" colspan="2">Parts</td>

                                    <td class="text-truncate text-center" colspan="2">{{ number_format($data['partsTotal'], 2) }}</td>
                                  </tr>
                                    <tr class="table-td-clr">
                                    <td class="text-truncate text-center t-br" colspan="2">Detail</td>

                                    <td class="text-truncate text-center" colspan="2">{{ $data['quote']->additional_value ? $data['quote']->additional_value->remove_and_replace : '--' }}</td>
                                  </tr>
                                    <tr>
                                    <td class="text-truncate text-center t-br" colspan="2">Subtotal</td>
                                    <td class="text-truncate text-center" colspan="2">{{ number_format($data['subTotal'], 2) }}</td>
                                  </tr>

                                  <?php if($data['discountPrice'] > 0 ){ ?>
                                  <tr>
                                    <td class="text-truncate text-center t-br" colspan="2">Discount({{ $discount->percent_discount }}%)</td>
                                    <td class="text-truncate text-center" colspan="2">{{ number_format($data['discountPrice'], 2) }}</td>
                                  </tr>
                                  <?php } ?>
                                  <tr>
                                    <td class="text-truncate text-center t-br" colspan="2">Subtotal (Including Parts)</td>
                                    <td class="text-truncate text-center" colspan="2">{{ number_format($data['subTotal'] - $data['discountPrice'] + $data['partsTotal'], 2) }}</td>
                                  </tr>
                                            <tr class="table-td-clr">
                                    <td class="text-truncate text-center t-br" colspan="2">GST({{ $data['companyDetail'] ? $data['companyDetail']->gst : 0 }}%)</td>
                                    <td class="text-truncate text-center" colspan="2">{{ number_format($data['gstPrice'], 2) }}</td>
                                  </tr>
                                            <tr>
                                    <td class="text-truncate text-center t-br" colspan="2">Total</td>
                                    <td class="text-truncate text-center" colspan="2">{{ number_format($data['total'], 2) }}</td>
                                  </tr>
                                        </tbody>
                                      </table>
                                  </div>

                                </div>

                            </div>
                               <div class="col-md-12 qs-table3 images-qs mt-1">
                                    <div class="col-md-6">
                                        <div class="col-md-12 row p-0" style="margin:0">
                                            @foreach ($data['quote']->images as $img)
                                                <div class="col-md-4 col-sm-6 p-0">
                                                    <a data-magnify="gallery" data-src="" data-caption="" data-group="a" href="{{ asset($img->image_url) }}">
                                                        <img class="qs-img" width="100px" src="{{ asset($img->image_url) }}">
                                                    </a>
                                                </div>&emsp;&emsp;&emsp;&emsp;
                                            @endforeach

                                        </div>
                                    </div>

                                </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
     </form>
</div>
