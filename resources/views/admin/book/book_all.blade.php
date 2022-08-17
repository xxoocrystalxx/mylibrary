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
                        <h4 class="mb-sm-0">Book List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Book List</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Genres</th>
                                        <th>Date of Publish </th>
                                        <th>Rating</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $key => $item)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item['author']['name'] }}</td>
                                            <td>
                                                @foreach ($item->genres as $genre)
                                                    <span>{{ $genre->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->date_publish }}</td>
                                            <td>{{ $item->rating() }}</td>
                                            <td><img src="{{ !empty($item->image) ? url($item->image) : url('images/no_image.jpg') }}"
                                                    style="width: 60px; height:60px">
                                            </td>
                                            <td><a href="{{ route('edit.book', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('delete.book', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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
