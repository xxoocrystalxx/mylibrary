<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frotend/assets/img/favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>
    <!-- preloader-start -->
    <div id="preloader">
        <div class="rasalina-spin-box"></div>
    </div>
    <!-- preloader-end -->
    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->
    <!-- header-area -->
    @include('frotend.body.header')
    <!-- header-area-end -->
    <!-- main-area -->
    <main>
        @yield('main')
    </main>
    <!-- main-area-end -->
    <!-- Footer-area -->
    @include('frotend.body.footer')
    <!-- Footer-area-end -->

    <!-- JS here -->
    <script src="{{ asset('frotend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/element-in-view.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/main.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
</body>

</html>
