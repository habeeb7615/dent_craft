<x-app-layout>
    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Change Password', 'description' => '', 'show_search' => false])
        <div class="change-password-wrapper remain-height common-padding-lr">
            <div class="change-password-form">
                <form id="change-password" >
                    <div class="form-group password-group">
                        <label>Current Password <span><sup><i class="fa fa-star fa-size text-danger"></i></sup></span></label>
                        <div style="position: relative;">
                            <input id="old_password" name="old_password" type="password" maxlength="12" required />
                            <i id="show_old_password" class="fa fa-eye password-eye"></i>
                            <i id="hide_old_password" class="fa fa-eye-slash password-eye d-none"></i>
                        </div>
                        <span class="text-custom"></span>
                    </div>
                    <div class="form-group">
                        <label>New Password
                            <span><sup><i class="fa fa-star fa-size text-danger"></i></sup></span>
                            <button type="button" class="password-question" data-toggle="tooltip" data-placement="top" title="Password must contain one upper, one lower, one digit, one special character and length must be between 8 and 12">
                                <img src="{{ asset('new-theme/images/question.svg') }}" alt="" />
                            </button>
                        </label>
                        <div style="position: relative;">
                            <input id="password" name="password" type="password" minlength="8" maxlength="12" required />
                            <i id="show_password" class="fa fa-eye password-eye"></i>
                            <i id="hide_password" class="fa fa-eye-slash password-eye d-none"></i>
                        </div>
                        <span class="text-custom"></span>
                    </div>
                    <div class="form-group">
                        <label>Re-Type New Password
                            <span><sup><i class="fa fa-star fa-size text-danger"></i></sup></span>
                            <button type="button" class="password-question" data-toggle="tooltip" data-placement="top" title="Password must contain one upper, one lower, one digit, one special character and length must be between 8 and 12">
                                <img src="{{ asset('new-theme/images/question.svg') }}" alt="" />
                            </button>
                        </label>
                        <div style="position: relative;">
                            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" maxlength="12" required />
                            <i id="show_password_confirmation" class="fa fa-eye password-eye"></i>
                            <i id="hide_password_confirmation" class="fa fa-eye-slash password-eye d-none"></i>
                        </div>
                        <span class="text-custom"></span>
                    </div>
                    <div class="update-btn">
                        <button id="change-password-submit" type="submit" class="btn-primary">
                            {{-- <img src="{{ asset('new-theme/images/update.svg') }}" alt=""> --}}
                            <span>Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footer')
    </div>

    @push('scripts')
        <script>
            $.validator.addMethod("strong_password", function(value) {
                return /[A-Z]/.test(value) // has an uppercase letter
                    && /[!@#\$%\^\&*\(\)-_=+]/.test(value) // has a special character
                    && /[a-z]/.test(value) // has a lowercase letter
                    && /\d/.test(value) // has a digit
            }, 'Password must follow the format Hello@123');

            function validateThisForm(form, button, valid=null) {
                $(form).validate({
                    rules: {
                        password: {
                            strong_password: true
                        },
                        password_confirmation: {
                            strong_password: true
                        }
                    }
                });

                if (valid == null) {
                    $(button).attr('disabled', true);
                    $(button).addClass('disabled');
                }

                $('input,textarea').on('blur keyup', function() {
                    $('.text-custom').html('')
                    if ($(form).valid()) {
                        $(button).prop('disabled', false);
                        $(button).removeClass('disabled');
                    } else {
                        $(button).prop('disabled', true);
                        $(button).addClass('disabled');
                    }
                });
            }
            validateThisForm('#change-password', '#change-password-submit')

            function showErrors(errors) {
                for(var error in errors) {
                    $('#'+error).siblings('span').html(errors[error])
                }
            }

            function clearErrors(el) {
                $(el+' input').siblings('span').html('')
            }

            function clearFields(el) {
                $(el+' input').val('')
            }

            $('#change-password').submit(function (e) {
                e.preventDefault()

                $.ajax({
                    url: "{{ route('admin.change_password') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        old_password: $('#old_password').val(),
                        password: $('#password').val(),
                        password_confirmation: $('#password_confirmation').val(),
                    },
                    success: function (response) {
                        if (response.status === 422) {
                            showErrors(response.errors)
                        }
                        else {
                            clearErrors('#change-password')

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Password changed successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            setTimeout(() => {
                                window.location.href = "{{ route('login') }}"
                            }, 1000);
                        }

                        clearFields('#change-password')
                    },
                    error: function (data) {
                        clearErrors('#change-password')
                        showErrors(data.responseJSON.errors)
                    }
                })
            })

            function registerEvents(password, showPass, hidePass) {
                $(showPass).click(function () {
                    $(password).attr('type', 'text')
                    $(this).addClass('d-none')
                    $(hidePass).removeClass('d-none')
                })

                $(hidePass).click(function () {
                    $(password).attr('type', 'password')
                    $(this).addClass('d-none')
                    $(showPass).removeClass('d-none')
                })
            }

            registerEvents('#old_password', '#show_old_password', '#hide_old_password')
            registerEvents('#password', '#show_password', '#hide_password')
            registerEvents('#password_confirmation', '#show_password_confirmation', '#hide_password_confirmation')

        </script>
    @endpush
</x-app-layout>
