@extends('index_main')
@section('index')
    <!-- ========== Left Sidebar Start ========== -->
    @include('admin.sidebar')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('admin')
        <!-- End Page-content -->

    </div>
    <!-- end main content-->
@endsection
