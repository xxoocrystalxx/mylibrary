@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Page</h4>
                            <form method="POST" action="{{ route('update.about') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $aboutpage->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="example-text-input" name="title" type="text"
                                            value="{{ $aboutpage->title }}">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="short_title" name="short_title" type="text"
                                            value="{{ $aboutpage->short_title }}">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="short_description" name="short_description" required="" rows="5">{{ $aboutpage->short_description }}</textarea>
                                    </div>
                                </div>

                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="elm1" name="long_description">{{ $aboutpage->long_description }}</textarea>
                                    </div>
                                </div>


                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="image" name="about_image" type="file">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="{{ !empty($aboutpage->about_image) ? url($aboutpage->about_image) : url('upload/no_image.jpg') }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->


                                <input type="submit" value="Update About Page"
                                    class="btn btn-info waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>
@endsection
