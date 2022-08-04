@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #b70000;
            font-weight: 700px;
            background-color: bisque;
            border-radius: 5px;
            padding: 3px;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Blog Edit Page</h4>
                            <form method="POST" action="{{ route('update.blog') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $blog->id }}">
                                <input type="hidden" name="image" value="{{ $blog->blog_image }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example"
                                            name="blog_category_id">
                                            <option selected="">Open this select menu</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $blog->blog_category_id ? 'selected' : '' }}>
                                                    {{ $item->blog_category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="blog_title" name="blog_title" type="text"
                                            value="{{ $blog->blog_title }}">
                                        @error('blog_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" data-role="tagsinput" name="blog_tags" type="text"
                                            value="{{ $blog->blog_tags }}">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="elm1" name="blog_description">{{ $blog->blog_description }}</textarea>
                                    </div>
                                </div>


                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="image" name="blog_image" type="file">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ asset($blog->blog_image) }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->


                                <input type="submit" value="Edit Blog Data" class="btn btn-info waves-effect waves-light">
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
