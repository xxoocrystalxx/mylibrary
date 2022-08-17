@extends('home.dashboard')
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
                            <h4 class="card-title">Edit Book Page</h4>
                            <form method="POST" action="{{ route('update.book') }}" enctype="multipart/form-data"
                                class="was-validated">
                                @csrf
                                <input type="hidden" name="id" value="{{ $book->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <select class="form-select select2" aria-label="Default select example"
                                            name="author_id" required>
                                            <option selected disabled value="">Open this select menu</option>
                                            @foreach ($authors as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $book->author_id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Author
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Book Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="title" name="title" type="text"
                                            value="{{ $book->title }}" required>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Genre</label>
                                    <div class="col-sm-10">
                                        <select class="select2 form-control select2-multiple" multiple="multiple"
                                            data-placeholder="Choose ..." name="genres[]" required>
                                            @foreach ($genres as $item)
                                                {{-- <option value="{{ $item->id }}">{{ $item->name }}</option> --}}
                                                <option value="{{ $item->id }}"
                                                    {{ $book->genres->contains($item->id) ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Genre
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Book
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="elm1" name="description">{{ $book->description }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date of publish</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="date_publish" name="date_publish" type="date"
                                            value={{ $book->date_publish }}>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="image" name="image" type="file">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="{{ !empty($book->image) ? url($book->image) : url('images/no_image.jpg') }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->


                                <input type="submit" value="Update Book" class="btn btn-info waves-effect waves-light">
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
