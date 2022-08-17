@extends('home.frotend')
@section('title')
    Edit review | My Library
@endsection
@section('main')
    <div class="page-content">
        <div class="container-md">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mytitle">Edit Review</h4>
                            <form method="POST" action="{{ route('update.review', $review->id) }}">
                                @csrf
                                <input name="book_id" type="hidden" value="{{ $review->book->id }}">
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-sm-2"><img
                                            src="{{ !empty($review->book->image) ? url($review->book->image) : url('upload/no_image.jpg') }}"
                                            width="50px;" height="72px;" style="float: right;">
                                    </div>
                                    <div class="col-sm-10">
                                        <h6>{{ $review->book->title }}</h6>
                                        <b>by {{ $review->book['author']['name'] }}</b>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">My Rating</label>
                                    <div class="col-sm-10 rating-star">
                                        <input type="hidden" class="rating write-review"
                                            data-filled="mdi mdi-heart text-danger"
                                            data-empty="mdi mdi-heart-outline text-danger" value="{{ $review->rating }}"
                                            name="rating" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Review</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="elm1" rows="5" name="comment" required>{{ $review->comment }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" value="Update" class="btn btn-info waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
