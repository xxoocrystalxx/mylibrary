@extends('home.frotend')
@section('title')
    Write review | My Library
@endsection
@section('main')
    <div class="page-content">
        <div class="container-md">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mytitle">Write Review</h4>
                            <form method="POST" action="{{ route('store.review') }}">
                                @csrf
                                <input name="book_id" type="hidden" value="{{ $book->id }}">
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-sm-2"><img
                                            src="{{ !empty($book->image) ? url($book->image) : url('upload/no_image.jpg') }}"
                                            width="50px;" height="72px;" style="float: right;">
                                    </div>
                                    <div class="col-sm-10">
                                        <h6>{{ $book->title }}</h6>
                                        <b>by {{ $book['author']['name'] }}</b>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">My Rating</label>
                                    <div class="col-sm-10 rating-star">
                                        <input type="hidden" class="rating write-review"
                                            data-filled="mdi mdi-heart text-danger"
                                            data-empty="mdi mdi-heart-outline text-danger"
                                            value="{{ $review ? $review->rating : 0 }}" name="rating" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Review</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="elm1" rows="5" name="comment" placeholder="Write your review" required></textarea>
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" value="Post" class="btn btn-info waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
