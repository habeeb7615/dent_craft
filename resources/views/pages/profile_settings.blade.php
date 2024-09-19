<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    @endpush
    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Profile', 'description' => '', 'show_search' => false])
        <div class="my-profile-section common-padding-lr after-header-section">
            <form class="mb-5" id="update-profile" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-profile-wrapper">
                    <h5>User Details</h5>
                    <div class="personal-info-wrapper row">
                        <div class="col-md-9 personal-info-formgroups">
                            <div>
                                <div class="form-group">
                                    <label>User Name <span><sup><i
                                                    class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                    <input id="name" name="name" type="text" value="{{ $user->name }}"
                                        minlength="2" maxlength="50" required />
                                    <span class="text-custom"></span>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input id="email" name="email" type="email" value="{{ $user->email }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="update-btn mt-5">
                                <button id="update-profile-submit" type="submit" class="btn-primary">
                                    {{-- <img src="{{ asset('new-theme/images/update.svg') }}" alt=""> --}}
                                    <span>Update</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 profile-image">
                            <span class="text-primary fz-2" id="img">Maximum file size must be 2
                                MB</span>
                            <span class="text-custom"></span>
                            <figure>
                                <img width="250" height="300" id='im' src="{{ $user->profile_image_url }}"
                                    alt="" />
                            </figure>
                            <button id="img_logo" type="button" class="btn-primary checked-detail">
                                {{-- <img src="{{ asset('new-theme/images/confirm.svg') }}" alt=""> --}}
                                <span>{{ $user->profile_image ? 'Profile Image' : 'Add Image' }}</span>
                            </button>
                            <input accept="image/*" id="uploadFile1" type="file" class="d-none" name="img">
                        </div>
                    </div>
                </div>

            </form>
            <form id="update-company" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-profile-wrapper">
                    <h5>Company Details</h5>
                    <div class="company-detail-wrapper row">
                        <div class="col-md-9 personal-info-formgroups">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="form-group">
                                        <label>Company Name <span><sup><i
                                                        class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                        <input id="cname" name="cname" maxlength="50" type="text"
                                            value="{{ $user->company_detail->company_name }}" required />
                                        <span class="text-custom"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="form-group">
                                        <label>Mobile Number <span><sup><i
                                                        class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                        <input id="phone" name="phone" minlength="8" maxlength="15"
                                            type="number" value="{{ $user->company_detail->mobile_number }}"
                                            required />
                                        <span class="text-custom"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="form-group">
                                        <label>ABN <span><sup><i
                                                        class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                        <input id="abn" name="abn" minlength="11" maxlength="11"
                                            type="number" value="{{ $user->company_detail->abn }}" required />
                                        <span class="text-custom"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="form-group">
                                        <label>Email Address <span><sup><i
                                                        class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                        <input id="company_email" name="email" maxlength="50" type="email"
                                            value="{{ $user->company_detail->email }}" required />
                                        <span class="text-custom"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="form-group">
                                        <!--<label>PO Box <span><sup><i-->
                                        <label>Address<span><sup><i
                                                        class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                        <input id="pobox" name="pobox" maxlength="255" type="text"
                                            value="{{ $user->company_detail->po_box }}" required />
                                        <span class="text-custom"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="gst-percentage-wrapper">
                                        <div class="form-group gst-percentage">
                                            <label>GST % <span><sup><i
                                                            class="fa fa-star fa-size text-danger"></i></sup></span></label>
                                            <input id="gst" name="gst" type="number" max="100"
                                                min="0" minlength="0" maxlength="6" class="form-control"
                                                value="{{ $user->company_detail->gst }}" required />
                                            <span class="text-custom"></span>
                                        </div>
                                        {{-- <div class="percentage-simbole">%</div> --}}
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class=" apply_GST_area_hp">
                                        <label>Apply GST</label>
                                        <div class="checkbox-con off">
                                            <input id="check_gst" name="check_gst" type="checkbox"
                                                @if ($user->company_detail->check_gst) checked @endif />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="form-group">
                                        <label>Timezone</label>
                                        <select class="select2 form-control" name="timezone" id="timezone">
                                            @foreach (config('timezones') as $timezone)
                                                <option @if ($timezone == $user->company_detail->timezone) selected @endif
                                                    value="{{ $timezone }}">{{ $timezone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="profile-image upload-logo">
                                <span class="text-primary fz-2" id="img2">Maximum file size must be
                                    2 MB</span>
                                <span class="text-custom"></span>
                                <figure>
                                    <img width="250" height="300" id='im2'
                                        src="{{ $user->company_detail->company_image_url }}" alt="" />
                                </figure>
                                <button id="img2_logo" type="button" class="btn-primary checked-detail">
                                    {{-- <img src="{{ asset('new-theme/images/confirm.svg') }}" alt="" /> --}}
                                    <span>{{ $user->company_detail->company_image ? 'Company Logo' : 'Add Image' }}</span>
                                </button>
                                <input accept="image/*" id="uploadFile2" type="file" class="d-none"
                                    name="img2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="update-btn">
                    <button id="update-company-submit" type="submit" class="btn-primary">
                        {{-- <img src="{{ asset('new-theme/images/update.svg') }}" alt=""> --}}
                        <span>Update</span>
                    </button>
                </div>
            </form>
        </div>
        @include('layouts.footer')
    </div>
    @push('scripts')
        <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
        <script>
            $('.select2').select2()

            validateForm('#update-profile', '#update-profile-submit', 'validate')
            validateForm('#update-company', '#update-company-submit', 'validate')

            function showErrors(errors) {
                for (var error in errors) {
                    $('#' + error).siblings('span.text-custom').html(errors[error])
                }
            }

            function clearErrors(el) {
                $(el + ' input').siblings('span.text-custom').html('')
            }

            function clearFields(el) {
                $(el + ' input').val('')
            }
            $(document).ready(function() {
                function readURL(input, el) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var image = new Image();

                        reader.onload = function(e) {
                            image.src = e.target.result;
                            image.onload = function() {
                                // access image size here
                                //if( this.width=='281' && this.height=='209'){
                                if (this.width) {
                                    $(el).attr("src", e.target.result);

                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Please upload  image of dimension 281X209 px for better results',
                                        showConfirmButton: false
                                    })
                                }
                            };
                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        $(el).attr("src", "https://via.placeholder.com/214.png?");
                    }
                }

                // function submitForm(id, url, message) {
                //     $(id).submit(function (e) {
                //         e.preventDefault()

                //         $.ajax({
                //             url: url,
                //             method: 'POST',
                //             data: $(id).serialize(),
                //             success: function (response) {
                //                 Swal.fire({
                //                     position: 'center',
                //                     icon: 'success',
                //                     title: message,
                //                     showConfirmButton: false,
                //                     timer: 1500
                //                 })
                //             },
                //             error: function (data) {
                //                 clearErrors(id)
                //                 showErrors(data.responseJSON.errors)
                //             }
                //         })
                //     })
                // }

                $(".imgAdd").click(function() {
                    $(this).closest(".row").find('.imgAdd').before(
                        '<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>'
                    );
                });

                $(document).on("click", "i.del", function() {
                    $(this).parent().remove();
                });

                $("#uploadFile1").change(function() {
                    $('#im').removeAttr('src');
                    readURL(this, '#im');
                });

                $("#uploadFile2").change(function() {
                    $('#im2').removeAttr('src');
                    readURL(this, '#im2');
                });

                // ajax form calls
                $('#update-profile').submit(function(e) {
                    e.preventDefault()

                    $.ajax({
                        url: "{{ route('admin.update_profile') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            clearErrors('#update-profile')
                            $('.user-profile img').attr('src', response.profile_image_url)
                            $('.user-profile h4').html(response.user_name)
                            $('#img_logo span').text('Change Image')

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Profile Detail updated successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: function(data) {
                            console.log(data.responseJSON);
                            console.log(data.responseJSON.errors.img[0]);
                           if(data.responseJSON.errors.img.length >0 && data.responseJSON.errors.img[0] == 'Uploaded file should be below 2 mb.'){
                                  Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Image size should be below 2 mb',
                                    
                                }).then(function() {
                                window.location.reload();
                                    });
                              
                            }
                            if (data.responseJSON.message ===
                                'The \"\" file does not exist or is not readable.') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Image size has exceeded the default value',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            clearErrors('#update-profile')
                            showErrors(data.responseJSON.errors)
                        }
                    })
                })

                $('#update-company').submit(function(e) {
                    e.preventDefault()

                    $.ajax({
                        url: "{{ route('admin.update_company') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            clearErrors('#update-company')
                            $('#img2_logo span').text('Change Image')

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Company Detail updated successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: function(data) {
                            
                            console.log(data.responseJSON.errors.img2[0]);
                           if(data.responseJSON.errors.img2[0] == 'Uploaded file must be below 2 mb.'){
                                  Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Image size should be below 2 mb',
                                    
                                }).then(function() {
                                window.location.reload();
                                    });
                              
                            }
                            if (data.responseJSON.message ===
                                'The \"\" file does not exist or is not readable.') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Image size has exceeded the default value',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            clearErrors('#update-company')
                            showErrors(data.responseJSON.errors)
                        }
                    })
                })
            });

            $("#img_logo").click(function() {
                $('#uploadFile1').click();
                return false;
            });

            $("#img2_logo").click(function() {
                $('#uploadFile2').click();
                return false;
            });
        </script>
    @endpush
</x-app-layout>
