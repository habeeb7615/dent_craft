<div class="app-content content" id="page2" style="display:none">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-center  col-12 mb-2 text-center">
                <h3 class="content-header-title mb-0 d-inline-block">Vehicle Details</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <!--<div class="row">
            <div class="col-12">
              <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your profile has been updated.
              </div>
            </div>
          </div>-->
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title form-section">Enter the Vehicle Registration / VIN Number</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" id="page2form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-2"></div>
                                            <div class="col-lg-6 col-sm-8">
                                                <div class="form-body">
                                                    <div class="row" style="margin-bottom: 20px;">
                                                        <div class="col-md-12 row">
                                                            <div class="col-md-6">
                                                                <input class="vehicle-radio-btn" @if (!empty($quote) && $quote->car_search_type == 1) checked @endif type="radio"
                                                                onclick="state_check(this)" name="type_of_search"
                                                                value="0"> <span
                                                                    class="color-black fw-600 rg-no">Registration
                                                                    Number</span>
                                                            </div>
                                                            <div class="col-md-6 m-mb-10">
                                                                <input class="vehicle-radio-btn" @if (!empty($quote) && $quote->car_search_type != 1) checked @endif onclick="state_check(this)"
                                                                type="radio" name="type_of_search" value="1"> <span
                                                                    class="color-black fw-600 rg-no">VIN
                                                                    Number</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-7">

                                                            <div class="form-group">
                                                                <input type="hidden" name="main_id"
                                                                    value="{{ !empty($quote) ? $quote->id : '' }}">
                                                                <input type="text" value="@if (!empty($quote) && $quote->car_search_type == 1)
                                                                {{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->reg_number : '' }}
                                                                @else
                                                                {{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->vin_number : '' }}
                                                  @endif" id="reg_num_page2" name="reg_num_page2"
                                                                    class="form-control "
                                                                    placeholder="Enter Registration No." required>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <select class="form-control" id="state_page2_drop" @if (!empty($quote) && $quote->car_search_type !=
                                                                1) style="display:none;" @endif
                                                                name="state_page2_drop">
                                                                <option value="NSW">New South Wales (NSW)</option>
                                                                <option value="VIC">Victoria (VIC)</option>
                                                                <option value="QLD">Queensland (QLD)</option>
                                                                <option value="TAS">Tasmania (TAS)</option>
                                                                <option value="SA">South Australia (SA)</option>
                                                                <option value="WS">Western Australia (WS)</option>
                                                                <option value="NT">Northern Territory (NT)</option>
                                                                <option value="ACT">Australian Capital Territory
                                                                    (ACT)</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <button onclick="check_reg_car()" type="button"
                                                                class="btn my-quotations-btn next-btn" disabled>Submit &
                                                                Check</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="col-md-12 row mt-3">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-body">
                                                    <div class="row">

                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Make</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="maker_page2"
                                                                    class="form-control" placeholder=""
                                                                    name="maker_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->make : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Model</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="model_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->model : '' }}" class="form-control" placeholder="" name="model_page2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Colour</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="color_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->colour : '' }}" class="form-control " placeholder="" name="color_page2">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Vin No.</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="vin_pag2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->vin_number : '' }}" class="form-control " placeholder="" name="vin_pag2">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Reg No.</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="reg_pag2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->reg_number : '' }}" class="form-control " placeholder="" name="reg_pag2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">State </label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="state_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->state : '' }}" class="form-control " placeholder="" name="state_page2">

                                                            </div>
                                                        </div>


                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Chassis</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="chassis_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->chassis : '' }}" class="form-control " placeholder="" name="chassis2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Year Of Manufacture</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="year_of_manufacture_page2"
                                                                    value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->year_of_manufacture : '' }}" class="form-control " placeholder=""
                                                                    name="year_of_manufacture2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Vehicle Type</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="vehicle_type_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->vehicle_type : '' }}" class="form-control " placeholder="" name="vehicle_type2">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Compliance Plate</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="compliance_plate_page2"
                                                                    value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->compliance_plate : '' }}" class="form-control " placeholder=""
                                                                    name="compliance_plate2">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Body Type</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="body_type_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->body_type : '' }}" class="form-control " placeholder="" name="body_type2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Engine Number</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="engine_number_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->engine_number : '' }}" class="form-control " placeholder="" name="engine_number2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Registration Status</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="registration_status_page2"
                                                                    value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->registration_status : '' }}" class="form-control " placeholder=""
                                                                    name="registration_status2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Registration Expiry Date</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text"
                                                                    id="registration_expiry_date_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->registration_expiry_date : '' }}" class="form-control " placeholder=""
                                                                    name="registration_expiry_date2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600"> WOV Type Code</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="wov_type_code_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->wov_type_code : '' }}" class="form-control " placeholder="" name="wov_type_code2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">WOV Jurisdiction</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="wov_jurisdiction_page2"
                                                                    value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->wov_jurisdiction : '' }}" class="form-control " placeholder=""
                                                                    name="wov_jurisdiction2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">WOV Damage Codes</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="wov_damage_codes_page2"
                                                                    value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->wov_damage_codes : '' }}" class="form-control " placeholder=""
                                                                    name="wov_damage_codes2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">WOV Incident Recorded Date</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text"
                                                                    id="wov_incident_recorded_date_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->wov_incident_date : '' }}" class="form-control " placeholder=""
                                                                    name="wov_incident_recorded_date2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">WOV Incident Code</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="wov_incident_code_page2"
                                                                    value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->wov_incident_code : '' }}" class="form-control " placeholder=""
                                                                    name="wov_incident_code2">
                                                            </div>
                                                        </div>



                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Insurance</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="insurance_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->insurance : '' }}" class="form-control" placeholder="" name="insurance_page2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Claim No.</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="claim_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->claim_number : '' }}" class="form-control" placeholder="" name="claim_page2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Sunroof</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" id="sunroof_page2" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->sunroof : '' }}" class="form-control " placeholder="" name="sunroof_page2">
                                                                <input type="hidden" id="if_stolen" value="{{ !empty($quote) && $quote->vehicle_detail ? $quote->vehicle_detail->if_stolen : '' }}" class="form-control " placeholder="" name="if_stolen">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12 text-center">
                                                            <button onclick="back_fun('1', '2')" type="button"
                                                                class="btn  my-quotations-btn next-btn pull-left">Back</button>
                                                            <button type="button"
                                                                class="btn  my-quotations-btn next-btn pull-right"
                                                                onclick="submitVehicleDetails()">Next</button>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<input type="hidden" id="skipped" value="0">

<!--Stolen Modal-->
<div class="modal fade" id="stolenvehicle" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center modal-inner">
                <p class="modal-text-2" id="text_special">The following vehicle Plate No ( <span
                        id="car_plat"></span> ) has been logged in as stolen in your database.</p>
            </div>
            <div class="modal-footer">
                <button onclick="cancel_qoute()" type="button" class="btn  my-quotations-btn next-btn pull-left"
                    data-dismiss="modal">Cancel Quote</button>
                <button type="button" class="btn   next-btn btn-danger pull-right" data-dismiss="modal">Proceed
                    Anyway</button>
            </div>
        </div>

    </div>
</div>

<!--Include Photos Modal-->
<div class="modal fade" id="includephotos" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Include Photos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center modal-inner">
                <p class="modal-text-2">Do you want to take photos?</p>
            </div>
            <div class="modal-footer">
                <button onclick="next_page_no_photo(4)" type="button" class="btn  my-quotations-btn next-btn"
                    data-dismiss="modal">No</button>
                <button onclick="next_page_evidence(3)" type="button" class="btn  my-quotations-btn next-btn">Yes,
                    Take Photos</button>
            </div>
        </div>

    </div>
</div>


<script>
    function  check_reg_car(){
        document.getElementById('divLoading').style.display = 'block';
        reg = $('#reg_num_page2').val();
        state = $('#state_page2_drop').val();
        type = $("input[name*='type_of_search']:checked").val();
        $.ajax({
            type: "POST",
            url: "{{ route('admin.quotation.check_vehical_reg') }}",
            data: {_token: '{{ csrf_token() }}', reg:reg ,state:state,type:type }, // serializes the form's elements.
            success: function(data)
            {
                obj=jQuery.parseJSON(data);
                if(obj.stolen=="yes"){
                    //$("#page2form")[0].reset()
                    $('#car_plat').html(reg);
                    document.getElementById('divLoading').style.display = 'none';
                    //new alert//

                    const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger',
                        confirmButton: 'btn btn-success'

                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        html: $('#text_special').html(),
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel Quote',
                        confirmButtonText: 'Proceed Anyway',

                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            //proceed
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            //cancel
                            cancel_qoute();
                        }
                    })
                    $("#if_stolen").val(1);
                }else{
                    $("#if_stolen").val(0);
                }

                document.getElementById('divLoading').style.display = 'none';

                if(typeof(obj.errors) != "undefined" && obj.errors != null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please enter correct registration number!'
                    })
                }else{
                    var resultArray = Object.keys(obj).map(function(personNamedIndex){
                    let person = obj[personNamedIndex];
                    var resultArray2 = Object.keys(person).map(function(personNamedIndex2){
                    let person2 = person[personNamedIndex2];
                    //console.log( person2[0].vin);

                    if(type==1){


                    $('#vin_pag2').val(person2.vin);
                    $('#state_page2').val(person2.plate.state);
                    $('#reg_pag2').val(person2.plate.number);
                    $('#maker_page2').val(person2.make);
                    $('#model_page2').val(person2.model);
                    $('#color_page2').val(person2.colour);

                      if(person2.chassis!=null){
                          $('#chassis_page2').val(person2.chassis);
                    }else{
                        $('#chassis_page2').val("  NULL ");
                    }

                    if(person2.year_of_manufacture){
                        $('#year_of_manufacture_page2').val(person2.year_of_manufacture);
                    }else{
                        $('#year_of_manufacture_page2').val("  NULL ");
                    }

                    $('#vehicle_type_page2').val(person2.vehicle_type);
                    $('#compliance_plate_page2').val(person2.compliance_plate);
                    $('#body_type_page2').val(person2.body_type);
                    $('#engine_number_page2').val(person2.engine_number);
                    $('#registration_status_page2').val(person2.registration.status);
                    var expir =  person2.registration.expiry_date;
                    arr = expir.split("-");
                    $('#registration_expiry_date_page2').val(arr[2]+'-'+arr[1]+'-'+arr[0]);

                    if(person2.wov.type_code!=null){
                        $('#wov_type_code_page2').val(person2.wov.type_code);
                    }else{
                        $('#wov_type_code_page2').val("  NULL ");
                    }
                    //$('#wov_type_code_page2').val(person2[0].wov.type_code);

                    if(person2.wov.jurisdiction!=null){
                         $('#wov_jurisdiction_page2').val(person2.wov.jurisdiction);
                    }else{
                        $('#wov_jurisdiction_page2').val("  NULL ");
                    }

                     if(person2.wov.damage_codes!=null){
                          $('#wov_damage_codes_page2').val(person2.wov.damage_codes);
                    }else{
                        $('#wov_damage_codes_page2').val("  NULL ");
                    }

                    if(person2.wov.incident_recorded_date!=null){
                          $('#wov_incident_recorded_date_page2').val(person2.wov.incident_recorded_date);
                    }else{
                        $('#wov_incident_recorded_date_page2').val("  NULL ");
                    }

                    if(person2.wov.incident_code!=null){
                          $('#wov_incident_code_page2').val(person2.wov.incident_code);
                    }else{
                        $('#wov_incident_code_page2').val("  NULL ");
                    }

                    }else{
                    $('#vin_pag2').val(reg);
                    $('#reg_pag2').val(person2[0].plate.number);
                    $('#state_page2').val(person2[0].plate.state);
                    $('#maker_page2').val(person2[0].make);
                    $('#model_page2').val(person2[0].model);
                    $('#color_page2').val(person2[0].colour);

                      if(person2[0].chassis!=null){
                          $('#chassis_page2').val(person2[0].chassis);
                    }else{
                        $('#chassis_page2').val("  NULL ");
                    }



                     if(person2[0].year_of_manufacture){


                           $('#year_of_manufacture_page2').val(person2[0].year_of_manufacture);
                    }else{
                        $('#year_of_manufacture_page2').val("  NULL ");
                    }


                    $('#vehicle_type_page2').val(person2[0].vehicle_type);
                    $('#compliance_plate_page2').val(person2[0].compliance_plate);
                    $('#body_type_page2').val(person2[0].body_type);
                    $('#engine_number_page2').val(person2[0].engine_number);
                    $('#registration_status_page2').val(person2[0].registration.status);
                    var expir =  person2[0].registration.expiry_date;
                         arr = expir.split("-");
                         $('#registration_expiry_date_page2').val(arr[2]+'-'+arr[1]+'-'+arr[0]);

                    if(person2[0].wov.type_code!=null){
                        $('#wov_type_code_page2').val(person2[0].wov.type_code);
                    }else{
                        $('#wov_type_code_page2').val("  NULL ");
                    }
                    //$('#wov_type_code_page2').val(person2[0].wov.type_code);

                    if(person2[0].wov.jurisdiction!=null){
                         $('#wov_jurisdiction_page2').val(person2[0].wov.jurisdiction);
                    }else{
                        $('#wov_jurisdiction_page2').val("  NULL ");
                    }

                     if(person2[0].wov.damage_codes!=null){
                          $('#wov_damage_codes_page2').val(person2[0].wov.damage_codes);
                    }else{
                        $('#wov_damage_codes_page2').val("  NULL ");
                    }

                    if(person2[0].wov.incident_recorded_date!=null){
                          $('#wov_incident_recorded_date_page2').val(person2[0].wov.incident_recorded_date);
                    }else{
                        $('#wov_incident_recorded_date_page2').val("  NULL ");
                    }

                    if(person2[0].wov.incident_code!=null){
                          $('#wov_incident_code_page2').val(person2[0].wov.incident_code);
                    }else{
                        $('#wov_incident_code_page2').val("  NULL ");
                    }
                    }
                });
                });
                }
          },
          errors: function (request, errors) {
        alert(" Can't do because: " + errors);
    },
         });
     }
</script>
