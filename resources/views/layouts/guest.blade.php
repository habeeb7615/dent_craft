<!DOCTYPE html>
<html lang="en">

    <head>
        <title>:: DentCraft ::</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="images/footer-logo.svg" sizes="16x16">

        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/font-awesome.min.css') }}">
        <link id="theme" rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/media.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/custom.css') }}">

        @stack('styles')
    </head>

<body>
    {{-- <div class="pre-loader d-none">
        <div class="pre-loader-content">
            <img src="{{ asset('new-theme/images/Spinner.gif') }}" alt="">
            <h4>Loading Data...</h4>
        </div>
    </div> --}}
    <div class="pre-loader d-none">
        <div class="pre-loader-content">
            <img id="loading" src="{{ asset('new-theme/images/spinner.svg') }}" alt="">
            <h4>Loading...</h4>
        </div>
    </div>

    {{ $slot }}

    <script src="{{ asset('new-theme/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('new-theme/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('new-theme/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="{{ asset('new-theme/js/custom.js') }}"></script>
    <script>
        // window.onload = function() {
        //     let theme = localStorage.getItem('theme');

        //     theme = theme == 'dark' ? 'style' : 'light-theme'

        //     let assetString = 'new-theme/css/'+theme+'.css'
        //     let asset = "{{ asset(':string') }}";
        //     asset = asset.replace(':string', assetString);
        //     document.getElementById('theme').setAttribute('href', asset);
        // }

        function validateForm(form, button) {
            $(form).validate();

            $(button).attr('disabled', true);
            $(button).addClass('disabled');

            $('input').on('blur keyup', function() {
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
