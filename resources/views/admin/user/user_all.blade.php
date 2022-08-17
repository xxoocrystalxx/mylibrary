@extends('home.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Users List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Users List</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->type }}
                                            </td>
                                            <td><img src="{{ !empty($item->profile_image) ? url('upload/admin_images/' . $item->profile_image) : url('images/no_image.jpg') }}"
                                                    style="width: 60px; height:60px">
                                            </td>
                                            <td>
                                                @if ($item->id != $my)
                                                    <a href="{{ route('delete.user', $item->id) }}"
                                                        class="btn btn-danger sm" title="Delete Data" id="delete"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
