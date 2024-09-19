<!DOCTYPE html>
<html lang="en">

    <head>
        <title>:: DentCraft ::</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="{{ asset('new-theme/images/white_logo.svg') }}" sizes="16x16">

        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/extensions/sweetalert.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/font-awesome.min.css') }}">
        @stack('styles')
        @if(auth()->user()->theme == 'dark')
            <link id="theme" rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/style.css') }}">
        @else
            <link id="theme" rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/light-theme.css') }}">
        @endif
        {{-- <link id="theme" rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/style.css') }}"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/media.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/custom.css') }}">
    </head>

<body>
    <div class="pre-loader d-none">
        <div class="pre-loader-content">
            <img id="loading" />
            <h4>Loading...</h4>
        </div>
    </div>
    {{-- <div class="pre-loader d-none">
        <div class="pre-loader-content">
            <img src="{{ asset('new-theme/images/Spinner.gif') }}" alt="">
            <h4>Loading...</h4>
        </div>
    </div> --}}
    <div class="page-wrapper">
        @include('layouts.sidebar')
        {{ $slot }}
    </div>
    <script src="{{ asset('new-theme/js/jquery.min.js') }}"></script>
    {{-- <script>
        $(document).ready(function () {
            $('.pre-loader').removeClass('d-none');
        })
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('new-theme/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('new-theme/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.1.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="{{ asset('new-theme/js/custom.js') }}"></script>
    <script>
        function changeTheme() {
            let theme = 'dark';
            const currTheme = localStorage.getItem('theme');
            if (currTheme === 'dark') {
                theme = 'light';
            }

            $.ajax({
                url: "{{ route('admin.change_theme') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    theme: theme
                },
                success: function (response) {
                    const theme = response.user.theme == 'dark' ? 'style' : 'light-theme'

                    let assetString = 'new-theme/css/'+theme+'.css'
                    let asset = "{{ asset(':string') }}";
                    asset = asset.replace(':string', assetString);
                    document.getElementById('theme').setAttribute('href', asset);
                    localStorage.setItem('theme', response.user.theme);
                }
            })
        }

        // switch(document.readyState) {
        //     case 'uninitialized':
        //         $('.pre-loader').removeClass('d-none')
        //     break;
        //     case 'loading':
        //         const theme = localStorage.getItem('theme');
        //         if (!theme) {
        //             localStorage.setItem('theme', 'style');
        //             theme = localStorage.getItem('theme');
        //         }
        //         let assetString = 'new-theme/css/'+theme+'.css'
        //         let asset = "{{ asset(':string') }}";
        //         asset = asset.replace(':string', assetString);
        //         document.getElementById('theme').setAttribute('href', asset);
        //     break;
        //     case 'complete':
        //         $('.pre-loader').addClass('d-none')
        //     break;
        // }

        window.onload = function() {
            const theme = localStorage.getItem('theme');
            if (!theme) {
                localStorage.setItem('theme', '{{ auth()->user()->theme }}');
            }
        }

        function validateForm(form, button, valid = null) {
            $(form).validate();

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

        $(document).ajaxStart(function () {
            $('.pre-loader').removeClass('d-none')
        })

        $(document).ajaxComplete(function () {
            $('.pre-loader').addClass('d-none')
        })
    </script>
    @stack('scripts')
</body>

</html>
