<x-app-layout>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <?php if(!is_null($quote->deleted_at)){ ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card " id="add-page">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-12 row">
                                <h3 class="content-header-title mb-0 d-inline-block">Sorry! the quote has been deleted
                                </h3>
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
                <h5>Pre Authorisation</h5>
                <a href="{{ route('admin.quotation.print_summary', base64_encode($quote->id)) }}" target="_blank"
                    class="print-doc-link">
                    <img src="{{ asset('new-theme/images/printer.svg') }}" alt="" />
                    <span>Print</span>
                </a>
            </div>
            <div class="new-quotation-form">
                <form>
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
                                        <span>Address:</span>
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

                                        </div>
                                        <p>{{ $image->image_type === 'assessed_damage' ? 'Assessed Damage' : 'Pre Existing Condition' }}
                                            </p>
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
                                    <p>{{ $quote->customer_detail->customer_name ? $quote->customer_detail->customer_name : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Quote ID</span>
                                    <p>{{ $quote->quote_id }}</p>
                                </li>
                                <li>
                                    <span>Contact Number</span>
                                    <p>{{ $quote->customer_detail->contact_number ? $quote->customer_detail->contact_number : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Date</span>
                                    <p>{{ $quote->customer_detail->created_at->timezone($companyDetail->timezone) }}
                                    </p>
                                </li>
                                <li>
                                    <span>Technician</span>
                                    <p>{{ $quote->customer_detail->technician ? $quote->customer_detail->technician : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Estimator</span>
                                    <p>{{ $quote->customer_detail->estimator ? $quote->customer_detail->estimator : '--' }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="new-quotation-wrap">
                        <div class="car-authorisation-info-2column">
                            <ul>
                                <li>
                                    <span>Make</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->make ? $quote->vehicle_detail->make : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Insurance</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->insurance ? $quote->vehicle_detail->insurance : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Model</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->model ? $quote->vehicle_detail->model : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>VIN No.</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->vin_number ? $quote->vehicle_detail->vin_number : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Reg. No.</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->reg_number ? $quote->vehicle_detail->reg_number : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Claim No.</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->claim_number ? $quote->vehicle_detail->claim_number : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Colour</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->colour ? $quote->vehicle_detail->colour : '--' }}
                                    </p>
                                </li>
                                <li>
                                    <span>Sunroof</span>
                                    <p>{{ $quote->vehicle_detail && $quote->vehicle_detail->sunroof ? $quote->vehicle_detail->sunroof : '--' }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    @if (count($quote->damaged_areas) > 0)
                        <div class="new-quotation-wrap damage-area-wrapper">
                            <div class="table-responsive">
                                <!--<table class="mt-0">-->
                                <!--    <tr>-->
                                <!--        <th>Damaged Area</th>-->
                                <!--        <th>Quantity</th>-->
                                <!--        <th>Additional</th>-->
                                <!--        <th>Amount</th>-->
                                <!--    </tr>-->
                                    
                                <!--    @foreach ($quote->damaged_areas as $area)-->
                                    
                                <!--        <tr>-->
                                <!--            <td>{{ $area->panel_area_name }}</td>-->
                                <!--            <td>{{ count($area->guards) }}</td>-->
                                <!--            <td>-->
                                                
                                <!--                @foreach ($area->guards as $additon)-->
                                                  
                                <!--                    {{ $additon->name }}-->
                                <!--                    @if (!$loop->last)-->
                                <!--                        ,-->
                                <!--                    @endif-->
                                <!--                @endforeach-->
                                <!--            </td>-->
                                <!--            <td>${{ $area->guards()->sum('panel_cost') }}</td>-->
                                <!--        </tr>-->
                                <!--    @endforeach-->
                                <!--</table>-->
                                
                                
                                 <table class="mt-0">
                                    <tr>
                                        <th>Damaged Area</th>
                                        <th>Quantity</th>
                                        <th>Additional</th>
                                        <th>Amount</th>
                                    </tr>

                                    @foreach ($quote->damaged_areas as $area)
                                      @foreach ($area->guards as $additon)
                                           <tr>
                                         <td>{{ $area->panel_area_name }}</td>
                                            <td>1</td>
                                                    <td>{{ $additon->name }}</td>
                                            <td>${{ $additon->pivot->panel_cost }}</td>
                                               </tr>
                                                @endforeach
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
                                                <th>Amount</th>
                                            </tr>
                                            @foreach ($quote->parts as $part)
                                                      
                                                <tr>
                                                    <td>{{ $part->part_name }}</td>
                                                    <td
                                                   
                                                    >
                                                        {{ $part->pivot->part_quantity }}
                                                    </td>
                                                    <td>{{$part->pivot->part_total}}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($quote->image_notes != "")
                    <div class="new-quotation-wrap damage-area-wrapper estimate-breakdown-table">
                        <h5>Comments</h5>
                        <div class="table-responsive">
                           <h6 style="font-family: Poppins;"> {{$quote->image_notes }} </h6>
                            </div>
                        </div>
                    @endif
                    
                    @if (!empty($quote->additional_value))
                    <div class="new-quotation-wrap damage-area-wrapper estimate-breakdown-table">
                        <h5>Remove and Replace</h5>
                        <div class="table-responsive">
                           <h6 style="font-family: Poppins;"> {{$quote->additional_value->remove_n_replace }} : {{$quote->additional_value->details }} </h6>
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
                                        
                                    <td>R&R(Remove and Replace)</td>
                                    <!--<td>{{ $quote->additional_value->details}}</td>-->
                                    <td>{{ $quote->additional_value->remove_n_replace}}</td>
                                </tr>
                                <tr>
                                    <td>SubTotal</td>
                                    <td>${{ number_format($subTotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Discount({{ $quote->discount ? $quote->discount->percent_discount : 0 }}%)</td>
                                    <!--//dsdsj-->
                                    <td>${{ number_format($discountPrice, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Subtotal (Including Parts)</td>
                                    <td>${{ number_format($subTotal + $partsTotal - $discountPrice, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>GST({{ $companyDetail && $companyDetail->check_gst ? $companyDetail->gst : 0 }}%)
                                    </td>
                                    <td>${{ number_format($gstPrice, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="estimae-total">
                           
                            @if(is_numeric($quote->additional_value->remove_n_replace))
                            
                            <h4>Total <span>${{ number_format($total, 2) +   number_format($quote->additional_value->remove_n_replace, 2)}}</span></h4>
                            @endif
                            @if(!is_numeric($quote->additional_value->remove_n_replace))
                              <h4>Total <span>${{ number_format($total, 2)}}</span></h4>
                            @endif
                        </div>
                    </div>
                    <div class="form-submit">
                        @if ($quote->quote_status === 'draft')
                            <button type="button" onclick="javascript:submit_summary()"
                                class="btn btn-primary">Approve</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footer')
    </div>
    <?php } ?>
    <!--Email  Modal-->
    <div class="modal fade" id="template_email" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Email Template</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <form class="form" id="last_form_email">
                    <div class="modal-body modal-inner-1">
                        <?php

        if($quote->customer_detail->send_email_to_customer == 1 ){
           $email= $quote->customer_detail->email;
            $name= $quote->customer_detail->customer_name;
        }else{
            $email = $companyDetail->email;
            $name = $companyDetail->company_name;
        }
        $quoteid_ = $quote->quote_id;
        $template = $companyDetail->email_template;
        if(Auth::check()) {
            $template = auth()->user()->company_detail->email_template;
        }

        if($name!=''){
        $template = str_replace("{NAME}",$name,$template);
        }
        $template = str_replace("{REGISTRATION}",$quoteid_,$template);
        $template = str_replace("{YEAR}",$quote->vehicle_detail ? $quote->vehicle_detail->year_of_manufacture : '--',$template);
        $template = str_replace("{MAKE}",$quote->vehicle_detail ? $quote->vehicle_detail->make : '--',$template);
        $template = str_replace("{MODEL}",$quote->vehicle_detail ? $quote->vehicle_detail->model : '--',$template);
        $template = str_replace("{DATATIME}",$quote->created_at,$template);
        $template = str_replace("{ADMIN_URL}", url('/'),$template);
        $template = str_replace("{QUOTEID}",base64_encode($quote->id),$template);
        if($quote->vehicle_detail){
 ?>
                        <input type="hidden" value="1" id="check_for_car_info">

                        <?php }else{ ?>
                        <input type="hidden" value="0" id="check_for_car_info">
                        <?php  } ?>
                        <div class="form-group">
                            <label for="userinput1" class="fw-600">Emails</label>
                            <input type="hidden" id="ty">
                            <select style="width:100% !important" class="form-control js-example-tokenizer"
                                id="emails_multi" multiple="multiple" required>
                                <?php if(!is_null($email) && $email!='' ){ ?>
                                <option value="<?php echo $email; ?>" selected="selected" locked="locked">
                                    <?php echo $email; ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userinput1" class="fw-600">Template</label>
                            <input type="hidden" id="ty">
                            <textarea id="editor1" class="form-control border-primary" name="editor1"><?php echo $template; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary my-quotations-btn next-btn"
                            data-dismiss="modal">Cancel</button>
                        <button onclick="send_mail_last()" type="button"
                            class="btn btn-success btn-primary my-quotations-btn next-btn">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--userdetails Modal-->


    <div class="modal fade" id="userdetails_email" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Enter Details of the user Quotation will be sent to</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="form" id="last_form_email">
                    <div class="modal-body text-center modal-inner-1">
                        <div class="row">
                            <div class="col-md-4 tr"> <label for="userinput1" class="fw-600">Customer Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" id="last_cust_name" class="form-control" placeholder=""
                                        name="last_cust_name" required>
                                </div>
                            </div>
                            <div class="col-md-4 tr"> <label for="userinput1" class="fw-600">Email</label></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="email" id="last_cust_email" class="form-control " placeholder=""
                                        name="last_cust_email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  my-quotations-btn next-btn"
                            data-dismiss="modal">Cancel</button>
                        <button onclick="new_email_approve_fun()" type="button"
                            class="btn  my-quotations-btn next-btn">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="editor"></div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://unpkg.com/js-image-zoom/js-image-zoom.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-image-zoom/js-image-zoom.min.js"></script>

        <script>
            $('.js-example-tokenizer').select2({
                    tags: true,
                    placeholder: 'Select an option',
                    templateSelection: function(tag, container) {
                        // here we are finding option element of tag and
                        // if it has property 'locked' we will add class 'locked-tag'
                        // to be able to style element in select
                        var $option = $('.select2 option[value="' + tag.id + '"]');
                        if ($option.attr('locked')) {
                            $(container).addClass('locked-tag');
                            tag.locked = true;
                        }
                        return tag.text;
                    },
                })
                .on('select2:unselecting', function(e) {
                    // before removing tag we check option element of tag and
                    // if it has property 'locked' we will create error to prevent all select2 functionality
                    if ($(e.params.args.data.element).attr('locked')) {
                        e.select2.pleaseStop();
                    }
                });
            //                       $(".js-example-tokenizer").select2({
            //     tags: true,
            //     tokenSeparators: [',', ' ']
            // })
            CKEDITOR.replace('editor1');

            function new_email_approve_fun() {
                jQuery.validator.addMethod("validate_email", function(value, element) {

                    if (/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value)) {
                        return true;
                    } else {
                        return false;
                    }
                }, "Please enter a valid Email.");

                (function($, W, D) {
                    var JQUERY4U = {};
                    JQUERY4U.UTIL = {
                        setupFormValidation: function() {
                            $("#last_form_email").validate({
                                rules: {

                                    last_cust_email: {
                                        required: true,
                                        email: true
                                    },
                                },
                                messages: {
                                    last_cust_email: "Please enter a valid email address",
                                },
                            });
                        }
                    }
                    $(D).ready(function($) {
                        JQUERY4U.UTIL.setupFormValidation();
                    });
                })(jQuery, window, document);



                if ($("#last_form_email").valid()) {
                    $('#userdetails_email').modal('hide');
                    // document.getElementById('divLoading').style.display = 'block';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.quotation.approve_current_quote') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            main_id: <?php echo $quote->id; ?>,
                            email_check: 0,
                            email: $('#last_cust_email').val(),
                            name: $('#last_cust_name').val()
                        }, // serializes the form's elements.
                        success: function(data) {
                            document.getElementById('divLoading').style.display = 'none';
                            $('#emails_multi').append($("<option selected='selected' locked='locked'></option>")
                                .attr("value", $('#last_cust_email').val()).text($('#last_cust_email').val()));

                            temp = CKEDITOR.instances.editor1.getData();
                            newtemp = temp.replace("{NAME}", $('#last_cust_name').val());
                            $('#editor1').val(' ');
                            CKEDITOR.instances.editor1.setData(newtemp);
                            //$('#editor1').val(newtemp);
                            $('#template_email').modal('show');
                        }
                    });
                }
            }

            function submit_summary() {
                if ($('#check_for_car_info').val() == 1) {
                    if ($('#emails_multi').val() != '') {
                        $('#template_email').modal('show');
                    } else {
                        $('#userdetails_email').modal('show');
                    }


                    //$('#template_email').modal('show');
                } else {

                    Swal.fire(
                        'Warning!',
                        'Dont have car information!',
                        'danger'
                    )
                }
            }

            function send_mail_last() {
                if ($("#last_form_email").valid()) {
                    $('#template_email').modal('hide');

                    // document.getElementById('divLoading').style.display = 'block';
                    var formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('id', '{{ $quote->id }}');
                    formData.append('detail', $('#details').val());
                    formData.append('emails_multi', $('#emails_multi').val());
                    formData.append('email_temp', CKEDITOR.instances.editor1.getData());
                    $.ajax("{{ route('admin.quotation.submit_summary') }}", {
                        method: 'POST',
                        data: formData,

                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.success == 1) {
                                // document.getElementById('divLoading').style.display = 'none';
                                Swal.fire(
                                    'Email sent!',
                                    'Email has been sent. Thanks!',
                                    'success'
                                )


                                setTimeout(
                                    function() {
                                        window.location = "{{ route('admin.dashboard') }}";
                                    }, 1500);
                            }

                        },
                        error: function(data) {

                            // document.getElementById('divLoading').style.display = 'none';
                            Swal.fire(
                                'Email not sent!',
                                'Email not sent. Thanks!',
                                'error'
                            )


                        }
                    });
                }

            }

            count = 0;
            $(window).scroll(function() {

                var scrollTop = $(window).scrollTop();
                if (scrollTop > 400 && read == '1' && count == 0) {
                    count = 1;
                    $.ajax({
                        type: "POST",
                        url: '',
                        data: {
                            main_id: <?php echo $quote->id; ?>
                        }, // serializes the form's elements.
                        success: function(data) {


                        }
                    });
                }
            });


            function PrintElem() {
                document.getElementById('divLoading').style.display = 'block';
                html2canvas(document.getElementById("add-page"), {
                    onrendered: function(canvas) {

                        var imgData = canvas.toDataURL('image/png');
                        console.log('Report Image URL: ' + imgData);
                        var doc = new jsPDF('p', 'mm', [700, 400]); //210mm wide and 297mm high

                        doc.addImage(imgData, 'PNG', 10, 10);
                        doc.autoPrint();
                        doc.save('Quotation_<?php echo $quote->quote_id; ?>.pdf');
                        document.getElementById('divLoading').style.display = 'none';
                    }
                });

            }
        </script>
    @endpush

</x-app-layout>
