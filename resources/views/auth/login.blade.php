<x-guest-layout>
    <section class="login-section">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-panel-header">
                    <figure>
                        <img class="img-fluid" />
                    </figure>
                    <div class="logo-content">
                        <h1><strong>DentCraft</strong> NSW PTY LTD.</h1>
                        <p>Paintless Dent Removal</p>
                    </div>
                </div>
                <div class="login-form">
                    <h3>Login</h3>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p> --}}
                    <form id="login_form" method="POST">
                        <div class="form-group username-group">
                            <input id="email" class="form-control" type="email" name="email" placeholder="Email" maxlength="50" required/>
                            <span class="text-custom"></span>
                        </div>
                        <div class="form-group password-group">
                            <input id="password" class="form-control" type="password" name="password" placeholder="Password" maxlength="12" minlength="8" required />
                            <i id="show-password" class="fa fa-eye password-eye"></i>
                            <i id="hide-password" class="fa fa-eye-slash password-eye d-none"></i>
                            <span class="text-custom"></span>
                            {{-- <button type="button" class="password-question" data-toggle="tooltip" data-placement="top" title="Password must contain one UPPER, one lower, one d1g1t, one special ch@r@cter and length must be between 8 and 12">
                                <img src="{{ asset('new-theme/images/question.svg') }}" alt="" />
                            </button> --}}
                        </div>
                        <div class="form-group submit-btn">
                            <button id="login-form-submit" type="submit">Sign in</button>
                        </div>
                    </form>

                    <a id="forgot-password" href="{{ route('password.request') }}" class="menu-link">Forgot Password?</a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>

$.validator.addMethod("strong_password", function (value) {
    return /^[^\s]*$/.test(value); // has a digit not white space
}, 'Password must not contain white spaces');

    function validateLoginForm(form, button) {
        $(form).validate({
            rules: {
                password: {
                    strong_password: true
                }
            }
        });

        $('input').on('blur keyup', function () {
            $('.text-custom').html('');
            if ($(form).valid()) {
                $(button).prop('disabled', false);
            } else {
                $(button).prop('disabled', true);
            }
        });
    }

    // validateLoginForm('#login_form', '#login-form-submit');

            // validateForm('#login-form-submit')
            function showErrors(errors) {
                for(var error in errors) {
                    $('#'+error).siblings('span').html(errors[error])
                }
            }
            
            function clearErrors(el) {
                $(el+' input').siblings('span').html('')
            }
            
            $('#login_form').submit(function (e) {
                
                e.preventDefault()
                // validateForm('#login_form','#login-form-submit')
                validateLoginForm('#login_form', '#login-form-submit');
                $.ajax({
                    url: "{{ route('login') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function (response) {
                        window.location.href = "{{ route('admin.dashboard') }}"
                    },
                    error: function (data) {
                        clearErrors('#login_form')
                        showErrors(data.responseJSON.errors)
                    }
                })
            })

            $('#show-password').click(function () {
                $('#password').attr('type', 'text')
                $(this).addClass('d-none')
                $('#hide-password').removeClass('d-none')
            })

            $('#hide-password').click(function () {
                $('#password').attr('type', 'password')
                $(this).addClass('d-none')
                $('#show-password').removeClass('d-none')
            })
        </script>
    @endpush
</x-guest-layout>
