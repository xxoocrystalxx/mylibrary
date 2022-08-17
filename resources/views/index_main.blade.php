<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- select 2-->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    <!-- FORM EDITABLE css -->
    <link href="{{ asset('assets/libs/bootstrap-editable/css/bootstrap-editable.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Rating css -->
    <link href="{{ asset('assets/libs/bootstrap-rating/bootstrap-rating.css') }}" rel="stylesheet" type="text/css" />

    <!-- jquery.vectormap css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">

    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">


    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">
</head>

<body data-topbar="dark">

    <div id="preloader">
        <div class="rasalina-spin-box"></div>
    </div>


    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('home.header')
        @yield('index')
    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
            "showDuration": "1000",
            "hideDuration": "500",
            "timeOut": "1000",
        }
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/js/code.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <!-- SELECT 2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/select2.init.js') }}"></script>

    <!-- FORM XEDITABLE js -->
    <script src="{{ asset('assets/libs/bootstrap-editable/js/index.js') }}"></script>

    <!-- EDITABLE TABLE js -->
    <script src="{{ asset('assets/libs/table-edits/build/table-edits.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/table-author-editable.init.js') }}"></script>

    <!-- rating js -->
    <script src="{{ asset('assets/libs/bootstrap-rating/bootstrap-rating.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/rating-init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
