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
                    <h3>Forgot Password</h3>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p> --}}
                    <div id="forgot-password-wrapper">
                        <form id="forgot-password-form" method="POST">
                            <div class="form-group username-group">
                                <input id="email" class="form-control" type="email" name="email" placeholder="Email" maxlength="50" required />
                                <span class="text-custom"></span>
                            </div>
                            <div class="form-group submit-btn">
                                <button id="forgot-password-form-submit" type="submit">Send Email</button>
                            </div>
                        </form>
                    </div>
                    <a id="back-to-login" href="{{ route('login') }}" class="menu-link">Back to Login</a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            validateForm('#forgot-password-form', '#forgot-password-form-submit')

            function showErrors(errors) {
                for(var error in errors) {
                    $('#'+error).siblings('span').html(errors[error])
                }
            }

            function clearErrors(el) {
                $(el+' input').siblings('span').html('')
            }

            $('#forgot-password-form').submit(function (e) {
                e.preventDefault()

                $.ajax({
                    url: "{{ route('password.email') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: $('#email').val()
                    },
                    success: function (response) {
                        if (response.response_code == 200) {
                            $('#forgot-password-wrapper').html(`<h4 class="form-submit-success">${response.message}</h4>`)
                        }
                    },
                    error: function (data) {
                        clearErrors('#forgot-password-form')
                        showErrors(data.responseJSON.errors)
                    }
                })
            })
        </script>
    @endpush
</x-guest-layout>
