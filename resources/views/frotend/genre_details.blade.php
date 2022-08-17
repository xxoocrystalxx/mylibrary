@extends('home.frotend')
@section('title')
    {{ $genre->name }} | My Library
@endsection
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="row">
            <h3 class="mytitle">{{ $genre->name }}</h3>
        </div>

        <div class="mybox">
            <h3 class="mytitle"><i class="mdi mdi-bullhorn text-danger"></i> News Releases of {{ $genre->name }}</h3>
            <div class="newnovels">

                <ul>
                    @foreach ($genrebooks as $item)
                        <li>
                            <a href="{{ route('book.details', $item->id) }}">
                                <div class="book-image">
                                    <img src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                                </div>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="row genrelist">
            <h4 class="mytitle">All {{ $genre->name }} ordered by Rating</h3>
                <ul>
                    @foreach ($genrebooks as $item)
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
                                <h6>{{ $item['author']['name'] }}</h6>
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
    </div>
    <div id="AddLibraryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">Choose a status:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal mt-3" action="{{ route('store.library') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" id="book_id">
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="status" id="option1" value="Want to read"
                                    autocomplete="off" checked>
                                <label class="btn btn-outline-secondary btn-rounded waves-effect w-100" for="option1">Want
                                    to read</label>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="status" id="option2" value="Reading"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary btn-rounded waves-effect w-100"
                                    for="option2">Reading</label>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="status" id="option3" value="Read"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary btn-rounded waves-effect w-100"
                                    for="option3">Read</label>
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script type='text/javascript'>
        $(document).ready(function() {
            var exampleModal = document.getElementById('AddLibraryModal')
            exampleModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-book_id')
                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                // var modalTitle = exampleModal.querySelector('.modal-title')
                var modalBodyInput = exampleModal.querySelector('.modal-body #book_id')

                // modalTitle.textContent = 'New message to ' + recipient
                modalBodyInput.value = recipient
            })
        });
    </script>
@endsection
