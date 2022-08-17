<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row genrelist">
    <h4 class="mytitle">{{ $title }}</h3>
        <ul>
            @foreach ($books as $item)
                <li class="genrebox">
                    <div class="myitem genre-img-box">
                        <div class="book-image">
                            <a href="{{ route('book.details', $item->id) }}"><img
                                    src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                            </a>
                        </div>
                    </div>
                    <div class="genre-item">
                        <h5><a href="{{ route('book.details', $item->id) }}">{{ $item->title }}</a></h5>
                        <h6>by <a
                                href="{{ route('author.details', $item->author_id) }}">{{ $item['author']['name'] }}</a>
                        </h6>
                        <p class="genre-desc">
                            {!! Str::limit($item->description, 200) !!}</p>
                    </div>
                    <div class="genre-button">
                        @php
                            $isInMyLibrary = $user ? $user->mylibrary->where('book_id', $item->id)->first() : null;
                        @endphp
                        <button type="button" class="btn btn-outline-secondary btn-rounded waves-effect"
                            data-bs-toggle="modal" data-bs-target="#AddLibraryModal"
                            data-bs-book_id="{{ $item->id }}">
                            @if ($isInMyLibrary)
                                {{ $isInMyLibrary->status }}
                            @else
                                Add to
                                My
                                Library
                            @endif
                        </button>

                    </div>
                </li>
            @endforeach
        </ul>
</div>

@include('frotend.components.addMyLibraryModal')
