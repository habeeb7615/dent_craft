<x-guest-layout>
    <section class="login-section">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-panel-header">
                    <figure>
                        <img class="img-fluid" src="{{ asset('new-theme/images/white_logo.svg') }}" alt="" />
                    </figure>
                    <div class="logo-content">
                        <h1><strong>DentCraft</strong> NSW PTY LTD.</h1>
                        <p>Paintless Dent Removal</p>
                    </div>
                </div>
                <div class="login-form">
                    <h3>Reset Password</h3>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p> --}}
                    <div id="reset-password-wrapper">
                        <form id="reset-password-form" method="POST">
                            <div class="form-group username-group">
                                <input id="email" class="form-control" type="text" name="email" placeholder="Email" maxlength="50" value="{{ old('email', $request->email) }}" readonly />
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group password-group">
                                <input id="password" class="form-control" type="password" name="password" placeholder="Password" minlength="8" maxlength="12" required />
                                <span class="text-custom"></span>
                                <button type="button" class="password-question" data-toggle="tooltip" data-placement="top" title="Password must contain one UPPER, one lower, one d1g1t, one special ch@r@cter and length must be between 8 and 12">
                                    <img src="{{ asset('new-theme/images/question.svg') }}" alt="" />
                                </button>
                            </div>
                            <div class="form-group password-group">
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" minlength="8" maxlength="12" required />
                                <span class="text-custom"></span>
                                <button type="button" class="password-question" data-toggle="tooltip" data-placement="top" title="Password must contain one UPPER, one lower, one d1g1t, one special ch@r@cter and length must be between 8 and 12">
                                    <img src="{{ asset('new-theme/images/question.svg') }}" alt="" />
                                </button>
                            </div>
                            <div class="form-group submit-btn">
                                <button id="reset-password-form-submit" type="submit">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            validateForm('#reset-password-form', '#reset-password-form-submit')

            function showErrors(errors) {
                for(var error in errors) {
                    $('#'+error).siblings('span').html(errors[error])
                }
            }

            function clearErrors(el) {
                $(el+' input').siblings('span').html('')
            }

            $('#reset-password-form').submit(function (e) {
                e.preventDefault()

                $.ajax({
                    url: "{{ route('password.update') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        token: "{{ $request->route('token') }}",
                        email: $('#email').val(),
                        password: $('#password').val(),
                        password_confirmation: $('#password_confirmation').val(),
                    },
                    success: function (response) {
                        if (response.response_code == 200) {
                            $('#reset-password-wrapper').html(`<h4 class="form-submit-success">${response.message}</h4>`)
                        }
                    },
                    error: function (data) {
                        clearErrors('#reset-password-form')
                        showErrors(data.responseJSON.errors)
                    }
                })
            })
        </script>
    @endpush
</x-guest-layout>
