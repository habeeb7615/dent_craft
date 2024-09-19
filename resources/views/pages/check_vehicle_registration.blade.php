<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    @endpush
    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Check Vehicle Registration', 'description' => '', 'show_search' => true])
        <div class="new-quotation-wrapper after-header-section common-padding-lr">
            <div class="new-quotation-form">
                <form method="post" id="new-quotation" enctype="multipart/form-data">
                    @csrf
                    <div class="new-quotation-wrap">
                        {{-- <h5>02 - Vehicle Details</h5> --}}
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
                                    <option value="">Select state...</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->state_code }}">{{ $state->state_name }} ({{ $state->state_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group submit-check">
                                <button type="button" id="check_register_num" class="btn btn-primary disabled" disabled>Submit & Check</button>
                            </div>
                        </div>
                        <div class="input-group-wrapper vehicle-number-detail" id="VINNum">
                            <div class="form-group">
                                <input type="text" class="form-control" id="vinnum_quatation" name="vin_number" placeholder="Enter VIN Number">
                            </div>
                            <div class="form-group submit-check">
                                <button type="button" id="check_vin_num" class="btn btn-primary disabled" disabled>Submit & Check</button>
                            </div>
                        </div>
                        <div class="input-group-wrapper">
                            <div class="form-group">
                                <label>Make</label>
                                <input type="text" readonly disabled id="make" name="vehicle_details[make]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" readonly disabled id="model" name="vehicle_details[model]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Colour</label>
                                <input type="text" readonly disabled id="colour" name="vehicle_details[colour]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Vin No.</label>
                                <input type="text" readonly disabled id="vin_number" name="vehicle_details[vin_number]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Reg No.</label>
                                <input type="text" readonly disabled id="reg_number" name="vehicle_details[reg_number]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" readonly disabled id="state_id" name="vehicle_details[state]" class="form-control" />
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label>Chassis</label>-->
                            <!--    <input type="text" readonly disabled id="chassis" name="vehicle_details[chassis]" class="form-control" />-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <label>Year Of Manufacture</label>-->
                            <!--    <input type="text" readonly disabled id="year_of_manufacture" name="vehicle_details[year_of_manufacture]" class="form-control" />-->
                            <!--</div>-->
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <input type="text" readonly disabled id="vehicle_type" name="vehicle_details[vehicle_type]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Compliance Plate</label>
                                <input type="text" readonly disabled id="compliance_plate" name="vehicle_details[compliance_plate]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Body Type</label>
                                <input type="text" readonly disabled id="body_type" name="vehicle_details[body_type]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Engine Number</label>
                                <input type="text" readonly disabled id="engine_number" name="vehicle_details[engine_number]" class="form-control" />
                            </div>
                            {{-- <div class="form-group">
                                <label>Registration Status</label>
                                <input type="text" readonly disabled id="registration_status" name="vehicle_details[registration_status]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Registration Expiry Date</label>
                                <input type="text" readonly disabled id="registration_expiry_date" name="vehicle_details[registration_expiry_date]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Type Code</label>
                                <input type="text" readonly disabled id="wov_type_code" name="vehicle_details[wov_type_code]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Jurisdiction</label>
                                <input type="text" readonly disabled id="wov_jurisdiction" name="vehicle_details[wov_jurisdiction]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Damage Codes</label>
                                <input type="text" readonly disabled id="wov_damage_codes" name="vehicle_details[wov_damage_codes]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Incident Recorded Date</label>
                                <input type="text" readonly disabled id="wov_incident_date" name="vehicle_details[wov_incident_date]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>WOV Incident Code</label>
                                <input type="text" readonly disabled id="wov_incident_code" name="vehicle_details[wov_incident_code]" class="form-control" />
                            </div> --}}
                            <div class="form-group">
                                <label>Insurance</label>
                                <input type="text" readonly disabled id="insurance" name="vehicle_details[insurance]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Claim No.</label>
                                <input type="text" readonly disabled id="claim_number" name="vehicle_details[claim_number]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Sunroof</label>
                                <input type="text" readonly disabled id="sunroof" name="vehicle_details[sunroof]" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footer')
    </div>
    @push('scripts')
        <script>
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
                
                
                
                
                
                
                // $('#make').val(response.make)
                // $('#model').val(response.model)
                // $('#colour').val(response.colour)
                // $('#vin_number').val(response.vin)
                // $('#reg_number').val(response.plate.number)
                // $('#state_id').val(response.plate.state)
                // $('#chassis').val(response.chassis)
                // $('#year_of_manufacture').val(response.year_of_manufacture)
                // $('#vehicle_type').val(response.vehicle_type)
                // $('#compliance_plate').val(response.compliance_plate)
                // $('#body_type').val(response.body_type)
                // $('#engine_number').val(response.engine_number)
                // $('#registration_status').val(response.registration.status)
                // $('#registration_expiry_date').val(response.registration.expiry_date)
                // $('#wov_type_code').val(response.wov.type_code)
                // $('#wov_jurisdiction').val(response.wov.jurisdiction)
                // $('#wov_damage_codes').val(response.wov.damage_codes)
                // $('#wov_incident_date').val(response.wov.incident_recorded_date)
                // $('#wov_incident_code').val(response.wov.incident_code)
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
        </script>
    @endpush
</x-app-layout>
