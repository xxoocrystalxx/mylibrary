@extends('home.frotend')
@section('title')
    {{ $book->title }} | My Library
@endsection
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="row">
            <div class="col-sm vertical-bar">
                <div class="booklist-container">
                    <div class="book-image">
                        <img src="{{ !empty($book->image) ? url($book->image) : url('upload/no_image.jpg') }}">
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-rounded waves-effect" data-bs-toggle="modal"
                        data-bs-target="#AddLibraryModal" data-bs-book_id="{{ $book->id }}">
                        @if ($list)
                            <i class="fas fa-check"></i> {{ $list->status }}
                        @else
                            Add to My Library
                        @endif
                    </button>
                </div>

                <div class="rating-star">
                    <input type="hidden" class="rating book-details" data-filled="mdi mdi-heart text-danger"
                        data-empty="mdi mdi-heart-outline text-danger" value="{{ $review ? $review->rating : 0 }}" />
                    <input type="hidden" value="{{ $book->id }}" id="book_id">
                    <div style="display:none" class="spinner-border spinner-border-sm text-success myspinner"
                        role="status">
                    </div>
                    <div class="review" style="{{ !$review ? 'display:none;' : '' }}">
                        <a class="underline" href="{{ route('write.review', $book->id) }}">Write a Review?</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-9 horizontal-bar">
            <h3 class="mytitle">{{ $book->title }}</h3>
            <h4>by <a href="{{ route('author.details', $book->author_id) }}">{{ $book['author']['name'] }}</a></h4>

            <div class="rating-star">
                <input type="hidden" class="rating" data-filled="mdi mdi-heart text-danger"
                    data-empty="mdi mdi-heart-outline text-danger" value="{{ $book->rating() }}" disabled />
                <span class="badge bg-info">{{ $book->rating() }}</span>
            </div>

            <div class="hbox desc">
                <div class="desc-box">
                    {!! $book->description !!}
                </div>
                <a href="javascript:void(0)" class="underline show-btn">Show More/Less</a>
            </div>
            <div class="hbox">
                @foreach ($book['genres'] as $item)
                    <a href="{{ route('genre.details', $item->id) }}"
                        class="btn btn-outline-info btn-sm waves-effect waves-light"> {{ $item->name }}</a>
                @endforeach
            </div>
            <div class="hbox">
                <h3 class="row mytitle">
                    <div class="col-sm-11">
                        Other Book of {{ $book['author']['name'] }} ({{ $author_books->count() }})
                    </div>
                    <div class="col-sm-1 controlbox">
                        <a class="carousel-control-prev mycontrol" href="#recipeCarousel" role="button"
                            data-bs-slide="prev">
                            <i class="text-danger fas fa-arrow-alt-circle-left"></i>
                        </a>

                        <a class="carousel-control-next mycontrol" href="#recipeCarousel" role="button"
                            data-bs-slide="next">
                            <i class="text-danger fas fa-arrow-alt-circle-right"></i>
                        </a>
                    </div>
                </h3>
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($author_books as $i => $item)
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                <div class="col-md-3 myitem">
                                    <a href="{{ route('book.details', $item->id) }}">
                                        <div class="book-image">
                                            <img
                                                src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="hbox">
                <div class="comment comment__wrap">
                    <div class="comment__title">
                        <h4 class="title"><i class="fal fa-comments-alt"></i> Reviews</h4>
                    </div>
                    <ul class="comment__list">
                        @if ($review)
                            <h4 class="mytitle">My Review</h4>
                            <li class="comment__item">
                                <div class="comment__thumb">
                                    <img src="{{ !empty($user->profile_image) ? url('upload/admin_images/' . $user->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="" width="80px;" height="80px">
                                </div>
                                <div class="comment__content">
                                    <div class="comment__avatar__info">
                                        <div class="info">
                                            <h4 class="title">{{ $user->name }}</h4>
                                            <span
                                                class="date">{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="rating-star">
                                        <input type="hidden" class="rating" data-filled="mdi mdi-heart text-danger"
                                            data-empty="mdi mdi-heart-outline text-danger" value="{{ $review->rating }}"
                                            disabled="disabled" />
                                    </div>
                                    @if (empty($review->comment))
                                        <p><a href="{{ route('write.review', $book->id) }}"
                                                class="btn btn-outline-secondary btn-rounded waves-effect w-lg">Write
                                                a
                                                Review</a></p>
                                    @else
                                        <p>{{ $review->comment }}</p>
                                    @endif
                                </div>
                            </li>
                            <hr>
                        @else
                            <li class="comment__item"> <a href="{{ route('write.review', $book->id) }}"
                                    class="btn btn-outline-secondary btn-rounded waves-effect w-lg">Write a
                                    Review</a></li>
                        @endif
                        <h4 class="mytitle">All Reviews</h4>
                        @foreach ($reviews as $item)
                            <li class="comment__item">
                                <div class="comment__thumb">
                                    <img src="{{ !empty($item->user->profile_image) ? url('upload/admin_images/' . $item->user->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="" width="80px;" height="80px">
                                </div>
                                <div class="comment__content">
                                    <div class="comment__avatar__info">
                                        <div class="info">
                                            <h4 class="title">{{ $item->user->name }}</h4>
                                            <span
                                                class="date">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="rating-star">
                                        <input type="hidden" class="rating" data-filled="mdi mdi-heart text-danger"
                                            data-empty="mdi mdi-heart-outline text-danger" value="{{ $item->rating }}"
                                            disabled="disabled" />
                                    </div>
                                    <p>{{ $item->comment }}</p>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>

    </div>

    </div>

    @include('frotend.components.addMyLibraryModal')

    <script type='text/javascript'>
        $(document).ready(function() {
            $(".show-btn").on("click", function() {
                $(".desc-box").toggleClass("box--more-mode");
            });

            let items = document.querySelectorAll('.carousel .carousel-item')
            items.forEach((el) => {
                const minPerSlide = 4
                let next = el.nextElementSibling
                for (var i = 1; i < minPerSlide; i++) {
                    if (!next) {
                        // wrap carousel by using first child
                        next = items[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })
        });
    </script>
@endsection
