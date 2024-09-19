<x-app-layout>
{{-- <style>
.photos-upload-wrpper .form__image-container:after {
    content: "✕";
    text-shadow: 0 0 3px white;
    position: absolute;
    font-size: 2.5rem;
    top: 14% !important;
    left: 88% !important;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    font-weight: bold;
    color: red;
    opacity: 0;
    -webkit-transition: opacity 0.2s ease-in-out;
    transition: opacity 0.2s ease-in-out;
}
</style> --}}
    @push('styles')
        <link rel="stylesheet" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    @endpush
    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'New Quotation', 'description' => '', 'show_search' => true])
        <div class="new-quotation-wrapper after-header-section common-padding-lr">
            <div class="new-quotation-form">
                <form method="post" id="new-quotation" enctype="multipart/form-data">
                    @csrf
                    <div class="new-quotation-wrap">
                        <h5>01 - Customer Details</h5>
                        <div class="input-group-wrapper">
                            <div id="customer" class="form-group">
                                <label>Customer Name
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <input type="text" list="customers" id="customer_detailscustomer_name" name="customer_details[customer_name]" class="form-control" minlength="2" maxlength="50" autocomplete="off" />
                                <datalist id="customers">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->customer_name }}">
                                    @endforeach
                                </datalist>
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group">
                                <label>Contact Number
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <input type="number" id="customer_detailscontact_number" name="customer_details[contact_number]" class="form-control" min="0" minlength="10" maxlength="15" />
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group">
                                <label>Address
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <input type="text" id="customer_detailsaddress" name="customer_details[address]" class="form-control" maxlength="100" placeholder="" />
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group">
                                <label>Email
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <input type="email" id="customer_detailsemail" name="customer_details[email]" class="form-control" />
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group">
                                <label>Technician's Name
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <input type="text" id="customer_detailstechnician" name="customer_details[technician]" class="form-control" minlength="2" maxlength="50" />
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group">
                                <label>Estimator's Name
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <input type="text" id="customer_detailsestimator" name="customer_details[estimator]" class="form-control" minlength="2" maxlength="50" />
                                <span class="text-custom"></span>
                            </div>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="customer_details[send_email_to_customer]" id="Customeremail">
                            <label for="Customeremail">Checking this box will send email to the above mentioned Customer email</label>
                        </div>
                    </div>
                    <div class="new-quotation-wrap">
                        <h5>02 - Vehicle Details</h5>
                        <div class="radio-groups">
                            <div class="custom-radio">
                                <input type="radio" id="RegistrationNumber" name="type" value="0" checked>
                                <label for="RegistrationNumber">Registration Number</label>
                            </div>
                            <div class="custom-radio">
                                <input type="radio" id="VINNumber" name="type" value="1" >
                                <label for="VINNumber">VIN Number</label>
                            </div>
                        </div>
                        <div class="input-group-wrapper vehicle-number-detail" id="RegisterNum">
                            <div class="form-group" id="regisernum_quatation">
                                <input type="text" class="form-control" id="regnum_quatation" name="reg_number" placeholder="Enter Registration Number">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="regiserstate_quatation" name="state">
                                    <option value="">Select State...</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->state_code }}">{{ $state->state_name }} ({{ $state->state_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group submit-check">
                                <button type="button" id="check_register_num" class="btn btn-primary disabled"
                                style="font-family: sans-serif;"
                                disabled>Submit & Check</button>
                            </div>
                        </div>
                        <div class="input-group-wrapper vehicle-number-detail" id="VINNum">
                            <div class="form-group">
                                <input type="text" class="form-control" id="vinnum_quatation" name="vin_number" placeholder="Enter VIN Number">
                            </div>
                            <div class="form-group submit-check">
                                <button type="button" id="check_vin_num" class="btn btn-primary disabled"
                                style="font-family: sans-serif;"disabled>Submit & Check</button>
                            </div>
                        </div>
                        <div class="input-group-wrapper">
                            <div class="form-group">
                                <label>Make</label>
                                <input type="text" id="make" name="vehicle_details[make]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" id="model" name="vehicle_details[model]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Colour</label>
                                <input type="text" id="colour" name="vehicle_details[colour]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Vin No.</label>
                                <input type="text" id="vin_number" name="vehicle_details[vin_number]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Reg No.</label>
                                <input type="text" id="reg_number" name="vehicle_details[reg_number]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" id="state_id" name="vehicle_details[state]" class="form-control" />
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label>Chassis</label>-->
                            <!--    <input type="text" id="chassis" name="vehicle_details[chassis]" class="form-control" />-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <label>Year Of Manufacture</label>-->
                            <!--    <input type="text" id="year_of_manufacture" name="vehicle_details[year_of_manufacture]" class="form-control" />-->
                            <!--</div>-->
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <input type="text" id="vehicle_type" name="vehicle_details[vehicle_type]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Compliance Plate</label>
                                <input type="text" id="compliance_plate" name="vehicle_details[compliance_plate]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Body Type</label>
                                <input type="text" id="body_type" name="vehicle_details[body_type]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Engine Number</label>
                                <input type="text" id="engine_number" name="vehicle_details[engine_number]" class="form-control" />
                            </div>
                            {{-- <div class="form-group">
                                <label>Registration Status</label>
                                <input type="text" id="registration_status" name="vehicle_details[registration_status]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Registration Expiry Date</label>
                                <input type="text" id="registration_expiry_date" name="vehicle_details[registration_expiry_date]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Type Code</label>
                                <input type="text" id="wov_type_code" name="vehicle_details[wov_type_code]" class="form-control" />
                            </div> --}}
                            {{-- <div class="form-group">
                                <label>WOV Jurisdiction</label>
                                <input type="text" id="wov_jurisdiction" name="vehicle_details[wov_jurisdiction]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Damage Codes</label>
                                <input type="text" id="wov_damage_codes" name="vehicle_details[wov_damage_codes]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Incident Recorded Date</label>
                                <input type="text" id="wov_incident_date" name="vehicle_details[wov_incident_date]" class="form-control" /> --}}
                            {{-- </div>
                            <div class="form-group">
                                <label>WOV Incident Code</label>
                                <input type="text" id="wov_incident_code" name="vehicle_details[wov_incident_code]" class="form-control" />
                            </div> --}}
                            <div class="form-group">
                                <label>Insurance</label>
                                <input type="text" id="insurance" name="vehicle_details[insurance]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Claim No.</label>
                                <input type="text" id="claim_number" name="vehicle_details[claim_number]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Sunroof</label>
                                <input type="text" id="sunroof" name="vehicle_details[sunroof]" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="new-quotation-wrap">
                        <h5>03 - Photos</h5>
                        <h4 class="text-color-kj fz-2" >Assessed Damage</h4>
                        <div class="photos-upload-wrpper">
                            <label class="form__container" id="upload-container-assessed">
                                <div class="text-center">
                                    <img class="photo-camera">
                                    <p>Choose or Drag & Drop Files</p>
                                </div>
                                <input name="images[assessed_damage][]" class="form__file" id="upload-files-assessed" type="file" accept="image/*" multiple="multiple"/>
                            </label>
                            <div class="form__files-container">
                                <div class="files-container-assessed"></div>
                                <div id="files-list-container-assessed"></div>
                            </div>
                        </div>
                        <h4 class="text-color-kj fz-2" >Pre Existing Condition</h4>
                        <div class="photos-upload-wrpper">
                            <label class="form__container" id="upload-container-pre">
                                <div class="text-center">
                                    <img class="photo-camera">
                                    <p>Choose or Drag & Drop Files</p>
                                </div>
                                <input name="images[pre_existing_condition][]" class="form__file" id="upload-files-pre" type="file" accept="image/*" multiple="multiple"/>
                            </label>
                            <div class="form__files-container">
                                <div class="files-container-pre"></div>
                                <div id="files-list-container-pre"></div>
                            </div>
                        </div>
                        <div class="assessed-damage">
                            <div class="custom-checkbox">
                                <input type="checkbox" name="images[attach_images_in_email]" value="1" id="QuotationEmail">
                                <label for="QuotationEmail">Do you want to attach the photos in the Quotation Email?</label>
                            </div>
                            <p>Pre existing condition advises of anything that will not be covered in the quotation</p>
                            <div class="assessed-damage-checkboxes">
                                @foreach ($preExistingConditions as $condition)
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="images[precon][]" value="{{ $condition->id }}" id="precon-{{$condition->id}}">
                                        <label for="precon-{{$condition->id}}">{{ $condition->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div id="comments" class="input-group-wrapper mt-4">
                                <div class="form-group">
                                    <select class="select2 form-control mb-4" id="canned_comments">
                                        {{-- <option value="">Select Canned Comments</option> --}}
                                        <option></option>
                                        @foreach ($cannedComments as $comment)
                                            <option value="{{ $comment->comment }}">{{ $comment->title }}</option>
                                        @endforeach
                                    </select>
                                    <textarea class="form-control" name="images[image_notes]" placeholder="Add Notes" id="canned_comments_content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="new-quotation-wrap damage-area-wrapper">
                        <h5>04 - Damaged Area</h5>
                        <p class="heading-para">Check the Area that appears to be Damaged. You can check more than one option.</p>
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th>Panel Area</th>
                                    <th>Panel Cost</th>
                                    <th>Additional</th>
                                </tr>
                                @foreach ($damagedAreas as $damagedArea)
                                    @include('pages.quotation.partials.damaged_area', ['damagedArea' => $damagedArea, 'damagedAreasCount' => count($damagedAreas)])
                                @endforeach
                            </table>
                        </div>
                        <div class="add_custom_damaged_area_field row input-group-wrapper my-4">
                            <div class="col-6 form-group m-0">
                                <input type="text" class="form-control" id="add_custom_damaged_area_name" placeholder="Enter part name"/>
                            </div>
                            <div class="col-6 form-group m-0">
                                <select id="position" class="form-control">
                                    <option value="default">Default</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                        <div class="add_custom_damaged_area_field my-4 text-right">
                            <button type="button" id="submit_new_custom_damaged_area" class="mx-2 mb-2 btn btn-primary icon-btn">
                                <i class="bi bi-plus-circle-fill"></i>
                                Save Custom Damaged Area
                            </button>
                            <button type="button" class="add_custom_damaged_area mx-2 btn mb-2 btn-primary icon-btn">
                                <i class="bi bi-x-circle-fill"></i>
                                Cancel
                            </button>
                        </div>
                        <div class="add_custom_area my-4 text-right">
                            <button type="button" class="btn btn-primary mb-2 icon-btn add_custom_damaged_area">
                                <i class="bi bi-plus-circle-fill"></i>
                                Add Custom Damaged Area
                            </button>
                            @push('scripts')
                            <script>
                                var custom = 0;
                                $("#submit_new_custom_damaged_area").click(function(){

                                    var n = parseInt($(".table-responsive>table>tbody>tr").length)-1;

                                    // var cost = $("#add_custom_damaged_area_cost").val();

                                    // var guardtext = $("#add_custom_damaged_area_guard option:selected").text();

                                    // var guard = $("#add_custom_damaged_area_guard").val();

                                    var name = $("#add_custom_damaged_area_name").val();
                                    var position = $('#position').val();
                                    var customName = 'custom_'+custom;

                                    $.ajax({
                                        url: "{{ route('admin.quotation.add_custom_damaged_area') }}",
                                        method: "POST",
                                        data: {
                                            '_token': '{{ csrf_token() }}',
                                            // 'guard': guard,
                                            'panel_area_name': name,
                                            // 'cost': cost,
                                            'position': position,
                                            'count': n,
                                            'id': customName
                                        },
                                        success: function (response) {
                                            // var arg = [n,n,"'"+guardtext+"'",cost];

                                            // var button = '<button class="btn btn-primary icon-btn" type="button" onclick="add_damage_element('+arg+');">Remove</button>';

                                            // var row = '<tr id="damage_row'+n+'"><td>'+name+'</td><td><input type="hidden" name="damaged_areas['+n+'][price]" value="'+cost+'">'+cost+'</td><td><input type="hidden" name="damaged_areas['+n+'][guard_id]" value="'+guard+'">'+guardtext+'</td><td>'+button+'</td></tr>';

                                            $("#add_custom_damaged_area_name").val('');

                                            var tbody = $(".table-responsive>table>tbody");

                                            tbody.append(response.view);

                                            function add_damage_element(n,a,b,c){

                                                $('#damage_select'+a).append("<option value="+c+">"+b+"</option>");

                                                $("#damage_row"+a+"_"+c).remove();
                                            }

                                            $("#damage_select"+response.damaged_area.id).change(function(e){
                                                var damage_row = $("#damage_row"+response.damaged_area.id)
                                                var price_list = damage_row.find("td > input[list='priceslist']")

                                                var n = parseInt($(".table-responsive>table>tbody>tr").length)-1;
                                                var td1 = damage_row.find("td:nth-child(1)").html();
                                                var td2 = price_list.val();
                                                var td3 = $(this).val();
                                                var option_text = damage_row.find("option[value='"+td3+"']").text();

                                                price_list.val('0')

                                                if(!/^\d+$/.test(td2) || td2 == 0){
                                                    price_list.focus();
                                                    price_list.select();
                                                    $(this).val(1)
                                                    return ;
                                                }

                                                var total_damage_count = parseInt(response.damaged_areas_count) - 1;

                                                var number_of_damages = n - total_damage_count;

                                                n = n + 1;

                                                var arg = [n,"'"+response.damaged_area.id+"'","'"+option_text+"'",td3];

                                                var button = '<button class="btn btn-primary icon-btn" type="button" onclick="add_damage_element('+arg+');">Remove</button>';

                                                var row = '<tr id="damage_row'+response.damaged_area.id+'_'+td3+'"><td>'+td1+'</td><td><input type="hidden" name=damaged_areas['+response.damaged_area.id+']['+number_of_damages+'][guard_id]" value="'+td3+'">'+td2+'</td><td><input type="hidden" name="damaged_areas['+response.damaged_area.id+']['+number_of_damages+'][price]" value="'+td2+'">'+option_text+'</td><td>'+button+'</td></tr>';

                                                damage_row.after(row);

                                                damage_row.find("option[value='"+td3+"']").each(function() {
                                                    $(this).remove();
                                                });
                                            });

                                            custom++;
                                              $(".add_custom_damaged_area_field").slideToggle();
                                                 $(".add_custom_area").slideToggle();
                                        },
                                        error: function (data) {
                                            console.log(data);
                                            showErrors(data.responseJSON.errors)
                                        }
                                    })
                                });

                                $(".add_custom_damaged_area_field").slideUp();
                                $(".add_custom_damaged_area").click(function(){
                                    $(".add_custom_damaged_area_field").slideToggle();
                                    $("#add_custom_damaged_area_name").val("");
                                    // $("#position").val('none');
                                    $(".add_custom_area").slideToggle();
                                    // $(".add_custom_damaged_area_field").slideToggle();
                                });
                            </script>
                            @endpush
                        </div>
                    </div>
                    <div class="new-quotation-wrap damage-area-wrapper">
                        <h5>05 - Choose Parts</h5>
                        <p class="heading-para">Choose parts for your car, such as:</p>
                        <div class="choose-parts-checkboxes">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 left-parts parts">
                                    @foreach ($leftParts as $part)
                                        @include('pages.quotation.partials.part')
                                    @endforeach
                                </div>
                                <div class="col-lg-4 col-md-6 right-parts parts">
                                    @foreach ($rightParts as $part)
                                        @include('pages.quotation.partials.part')
                                    @endforeach
                                </div>
                                <div class="col-lg-4 col-md-6 none-parts parts">
                                    @foreach ($noneParts as $part)
                                        @include('pages.quotation.partials.part')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="add-custom-part-wrapper input-group-wrapper row" id="add_choose_part">
                            <div class="col-12 col-md-4 form-group">
                                <input type="text" class="form-control" id="add_choose_part_name" placeholder="Enter part name"/>
                            </div>
                            {{-- <div class="col-12 col-md-4 form-group">
                                <input type="number" class="form-control" id="part_unit_price" placeholder="Enter unit price" min="0"/>
                            </div> --}}
                            <div class="col-12 col-md-3 form-group">
                                <select class="form-control" id="add_choose_part_side">
                                    <option value="none">Default</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="float-right">
                                    <button type="button" id="add_choose_custom_part_save" class="btn mb-2 btn-primary icon-btn mr-3">
                                        <i class="bi bi-plus-circle-fill"></i>
                                       Save Custom Part
                                    </button>
                                    <button type="button" class="btn btn-primary mb-2 icon-btn add_choose_custom_part">
                                        <i class="bi bi-x-circle-fill"></i>
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="add-custom-part-wrapper" id="add_choose_part_tab">
                            <button type="button" class="btn btn-primary icon-btn add_choose_custom_part">
                                <i class="bi bi-plus-circle-fill"></i>
                                Add Custom Part
                            </button>
                        </div>
                        @push('scripts')
                            <script>
                                var custom = 0;

                                $("#add_choose_custom_part_save").click(function(){
                                    var customName = 'custom_'+custom;
                                    var name = $("#add_choose_part_name").val();
                                    // var unitPrice = $('#part_unit_price').val();
                                    var side = $("select#add_choose_part_side option:selected").val();

                                    if(name.trim() == ""){
                                        $("#add_choose_part_name").focus();
                                        return ;
                                    }


                                    // if(unitPrice == '' || unitPrice == '0') {
                                    //     $('#part_unit_price').focus()
                                    //     return ;
                                    // }

                                    $.ajax({
                                        url: "{{ route('admin.quotation.add_custom_part') }}",
                                        method: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            part_name: name,
                                            // unit_price: unitPrice,
                                            id: customName,
                                            position: side
                                        },
                                        success: function(response) {
                                            switch (response.part.position) {
                                                case 'left':
                                                    $('.left-parts').append(response.view)
                                                    break;
                                                case 'right':
                                                    $('.right-parts').append(response.view)
                                                    break;
                                                case 'none':
                                                    $('.none-parts').append(response.view)
                                                    break;
                                                default:
                                                    break;
                                            }
                                            // $(".choose-parts-checkboxes").append(response.view);
                                            newPartJS()
                                            custom++;
                                              $("div#add_choose_part_tab").slideToggle();
                                              $("div#add_choose_part").slideToggle();
                                        }
                                    })

                                    $("#add_choose_part_name").val("");
                                    $('#part_unit_price').val(0)
                                    $("#add_choose_part_name").focus();
                                });
                                $("div#add_choose_part").slideUp();

                                $(".add_choose_custom_part").click(function(){
                                    $("div#add_choose_part").slideToggle();
                                    $("#add_choose_part_name").val("");
                                    $("#add_choose_part_side").val('none');
                                    $("div#add_choose_part_tab").slideToggle();
                                });
                            </script>
                        @endpush
                    </div>
                    <div class="new-quotation-wrap">
                        <h5>06 - Remove and Replace</h5>
                        <p class="heading-para">Type in any additional dollar value</p>
                        <div class="input-group-wrapper mt-5">
                            <div class="form-group">
                                <div class="mb-4">
                                    <label>Remove & Replace</label>
                                    <input list="remove_n_replace" type="text" class="form-control" name="additional_values[remove_n_replace]">
                                    <datalist id="remove_n_replace">
                                        <option value="Bodyshop"></option>
                                    </datalist>
                                </div>
                                <div class="">
                                    <label>Details
                                        {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                    </label>
                                    <textarea class="form-control" id="additional_valuesdetails" name="additional_values[details]" placeholder="Enter Details"></textarea>
                                    <span class="text-custom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="new-quotation-wrap">
                        <h5>07 - Add Discount</h5>
                        <div class="input-group-wrapper">
                            <div class="form-group">
                                <label> Select the percentage of discount
                                    {{-- <sup><i class="fa fa-star fa-size text-danger"></i></sup> --}}
                                </label>
                                <select class="form-control" name="discounts[percent_discount]" id="discountspercent_discount">
                                    <option value="0">No Discount</option>
                                    @for ($i=1;$i<=100;$i++)
                                    <option value="{{ $i }}">{{ $i }}%</option>
                                    @endfor
                                </select>
                                <span class="text-custom"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-submit">
                        <button type="button" id="new-quotation-submit" class="btn btn-primary">Generate Quotation</button>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footer')
    </div>
    @push('scripts')
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/heic2any/0.0.3/heic2any.js"></script>-->
    <script src="{{ asset('new-theme/js/heic.js') }}"></script>
        <script src="{{ asset('new-theme/js/photo-upload.js') }}"></script>
        <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

        
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.2.1/compressor.min.js"></script>

         <!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinify.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.0.5/compressor.min.js"></script>


        <script>
            $('.select2').select2({
                placeholder: 'Select Canned Comment'
            })
            // $('.select2').select2({
            //     tags: true,
            //     placeholder: 'Select an option',
            //     templateSelection : function (tag, container){
            //             // here we are finding option element of tag and
            //         // if it has property 'locked' we will add class 'locked-tag'
            //         // to be able to style element in select
            //         var $option = $('#mySelect2 option[value="'+tag.id+'"]');
            //         if ($option.attr('locked')){
            //             $(container).addClass('locked-tag');
            //             tag.locked = true;
            //         }
            //         return tag.text;
            //     },
            // })
            // .on('select2:unselecting', function(e){
            //     // before removing tag we check option element of tag and
            //     // if it has property 'locked' we will create error to prevent all select2 functionality
            //     if ($(e.params.args.data.element).attr('locked')) {
            //         e.select2.pleaseStop();
            //     }
            // });

            google.maps.event.addDomListener(window, 'load', initialize);

            function initialize() {
                var input = document.getElementById('customer_detailsaddress');
                console.log(input);
                var autocomplete = new google.maps.places.Autocomplete(input,{
                    componentRestrictions : {country : ['au']}
                });
            }

            // Registration number & VIN number
            function setInputValues(response) {
      
                  if(response.result == null || response.result == ''){
                       Swal.fire({
                                position: 'center',
                                icon: 'danger',
                                title: 'Please enter valid detail.',
                               
                            })
                            return 0;
                  }

                $('#make').val(response.result[0].make)
                $('#model').val(response.result[0].model)
                $('#colour').val(response.result[0].colour)
                $('#vin_number').val(response.result[0].vin)
                $('#reg_number').val(response.result[0].registration.plate)
                $('#state_id').val(response.result[0].registration.state)
                // $('#chassis').val(response.result[0].chassis)
                $('#year_of_manufacture').val(response.result[0].year_of_manufacture)
                $('#vehicle_type').val(response.result[0].vehicle_type)
                $('#compliance_plate').val(response.result[0].compliance_plate)
                $('#body_type').val(response.result[0].body_type)
                $('#engine_number').val(response.result[0].engine_number)
              //  $('#registration_status').val(response.result[0].registration.status)
              //  $('#registration_expiry_date').val(response.result[0].registration.expiry_date)
              //  $('#wov_type_code').val(response.result[0].wov.type_code)
             //   $('#wov_jurisdiction').val(response.result[0].wov.jurisdiction)
               // $('#wov_damage_codes').val(response.result[0].wov.damage_codes)
              //  $('#wov_incident_date').val(response.result[0].wov.incident_recorded_date)
             //   $('#wov_incident_code').val(response.result[0].wov.incident_code)











               // $('#make').val(response.make)
               // $('#model').val(response.model)
               // $('#colour').val(response.colour)
               // $('#vin_number').val(response.vin)
                //$('#reg_number').val(response.plate.number)
                //$('#state_id').val(response.plate.state)
                //$('#chassis').val(response.chassis)
                //$('#year_of_manufacture').val(response.year_of_manufacture)
                //$('#vehicle_type').val(response.vehicle_type)
                //$('#compliance_plate').val(response.compliance_plate)
                //$('#body_type').val(response.body_type)
                //$('#engine_number').val(response.engine_number)
                //$('#registration_status').val(response.registration.status)
                //$('#registration_expiry_date').val(response.registration.expiry_date)
                //$('#wov_type_code').val(response.wov.type_code)
                //$('#wov_jurisdiction').val(response.wov.jurisdiction)
                //$('#wov_damage_codes').val(response.wov.damage_codes)
                //$('#wov_incident_date').val(response.wov.incident_recorded_date)
                //$('#wov_incident_code').val(response.wov.incident_code) --}}
            }

            $("#VINNum").slideUp();

            $("#VINNumber").click(function(){
                $("#VINNum").slideDown();
                $("#RegisterNum").slideUp();
                $("#regisernum_quatation").prop('disabled', true);
                $("#regiserstate_quatation").prop('disabled', true);
                $("#vinnum_quatation").prop('disabled', false);

            });

            $("#RegistrationNumber").click(function(){
                $("#RegisterNum").slideDown();
                $("#VINNum").slideUp();
                $("#regisernum_quatation").prop('disabled', false);
                $("#regiserstate_quatation").prop('disabled', false);
                $("#vinnum_quatation").prop('disabled', true);
            });

            $('#vinnum_quatation').on('input keyup', function () {
                if ($(this).val() === '') {
                    $('#check_vin_num').attr('disabled', true)
                    $('#check_vin_num').addClass('disabled')
                }else {
                    $('#check_vin_num').attr('disabled', false)
                    $('#check_vin_num').removeClass('disabled')
                }
            })

            $('#regnum_quatation').on('input keyup', function () {
                if ($(this).val() === '' || $('#regiserstate_quatation').val() === '') {
                    $('#check_register_num').attr('disabled', true)
                    $('#check_register_num').addClass('disabled')
                }else {
                    $('#check_register_num').attr('disabled', false)
                    $('#check_register_num').removeClass('disabled')
                }
            })

            $("#regiserstate_quatation").on('change', function () {
                if ($(this).val() === '' || $('#regnum_quatation').val() === '') {
                    $('#check_register_num').attr('disabled', true)
                    $('#check_register_num').addClass('disabled')
                }else {
                    $('#check_register_num').attr('disabled', false)
                    $('#check_register_num').removeClass('disabled')
                }
            })

            $('#check_vin_num').click(function() {
                $.ajax({
                    url: "{{ route('admin.quotation.check_vehical_reg') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: '1',
                        reg: $('#vinnum_quatation').val(),
                    },
                    success: function(response) {
                        setInputValues(response)
                    }
                })
            })

            $('#check_register_num').click(function() {
                $.ajax({
                    url: "{{ route('admin.quotation.check_vehical_reg') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: '0',
                        state: $('#regiserstate_quatation').val(),
                        reg: $('#regnum_quatation').val()
                    },
                    success: function(response) {
                        setInputValues(response)
                    }
                })
            })

            $("#canned_comments").change(function(){
                $("#canned_comments_content").val($("#canned_comments_content").val()+$("#canned_comments").val()+' ');
            });

            // validateForm('#new-quotation', '#new-quotation-submit')

            function showErrors(errors) {
                for(var error in errors) {
                    error_id = error.replace(".", "");
                    error_msg = errors[error][0];
                    $('#'+error_id).siblings('span').html(error_msg.replace(".", "&nbsp;in&nbsp;"));
                    $('#'+error_id).focus();
                    break;
                }
            }

            function clearErrors(el) {
                $(el+' input').siblings('span').html('')
            }

            function clearFields(el) {
                $(el+' input').val('')
            }

             $('#new-quotation-submit').click(function () {
                const form = $('#new-quotation')
                 var file_asses = 0
                 var file_pre = 0
                let fd = new FormData(form[0])
                var count_assessed = 0
                
                var exceeded_size_assessed = false
                var exceeded_size_pre = false

                

                if (FILES_ASSESSED.length <= 10 || FILES_PRE.length <= 10) {



                    FILES_ASSESSED.map(file => {
                         file_asses += file.size;
                        if (file.size > 2048000) {
                            exceeded_size_assessed = true
                        }
                        fd.append('uploaded_assessed_image'+count_assessed, file)
                        count_assessed++
                    });


                    FILES_PRE.map(file => {
                        file_pre += file.size;
                        if (file.size > 2048000) {
                            exceeded_size_pre = true
                        }
                        fd.append('uploaded_pre_image[]', file)
                       
                    });
                    console.log(FILES_PRE);
                      
                    if (file_asses < 10,240,000) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'All Assessed Image size must be less than 10MB.',
                        })
                    }
                     if (file_pre < 10,240,000 ) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'All Pre Existing Condition Image size must be less than 10MB.',
                        })
                    }
                    else {
                        for (var pair of fd.entries()) {
                       console.log(pair[0]+ ' - ' + pair[1]) }
                      
                        $.ajax({
                            url: "{{ route('admin.quotation.submit_page_data') }}",
                            method: 'POST',
                            processData: false,
                            contentType: false,
                            data: fd,
                            success: function (response) {
                                window.scrollTo(0,0);
                                if (response.status === 422) {
                                    showErrors(response.errors)
                                }
                                else {
                                    // clearErrors('#change-password')

                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Quotation created successfully.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                    setTimeout(() => {
                                        var id = btoa(response.data.quote_id)
                                        var url = "{{ route('admin.quotation.quotation-summary', ':id') }}"
                                        url = url.replace(':id', id)
                                        window.location.href = url
                                    }, 1500);

                                }
                            }
                        })
                    }
                }
                else {
                    var title = FILES_ASSESSED.length > 10 ? 'Assessed' : 'Pre Existing Condition'
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: title+' images must not be greater than 10',
                    })
                }
            })


            // $('#customer_detailscustomer_name').on('input', function () {
            //     clearTimeout(searchTimeout)
            //     var term = $(this).val()
            //     searchTimeout = setTimeout(function() {
            //         $.ajax({
            //             url: "{{ route('admin.quotation.customer_search') }}",
            //             method: 'POST',
            //             data: {
            //                 _token: '{{ csrf_token() }}',
            //                 term: term
            //             },
            //             success: function (response) {
            //                 var html = ''
            //                 response.data.forEach(customer => {
            //                     html += `<option value='${customer.customer_name}'>`
            //                 });
            //                 $('#customers').html(html)
            //             }
            //         })
            //     }
            //     ,500)
            // })

            $('#customer_detailscustomer_name').on('change', function() {
                var id = $(this).val()
                $.ajax({
                    url: "{{ route('admin.quotation.get_customer') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        if (response.data) {
                            $('#customer_detailscontact_number').val(response.data.contact_number)
                            $('#customer_detailsaddress').val(response.data.address)
                            $('#customer_detailsemail').val(response.data.email)
                            $('#customer_detailstechnician').val(response.data.technician)
                            $('#customer_detailsestimator').val(response.data.estimator)
                        }
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>
