@extends('home.frotend')
@section('title')
    My Library
@endsection
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="row">
            <table class="table mb-0 table-hover">
                <thead class="table-info">
                    <tr>
                        <th scope="col">cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Genres</th>
                        <th scope="col">AVG Rating</th>
                        <th scope="col">My Rating</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mylibrary as $item)
                        <tr>
                            <td><img src="{{ !empty($item->book->image) ? url($item->book->image) : url('upload/no_image.jpg') }}"
                                    width="50px;" height="72px;"></td>
                            <td><a class="underline" href="{{ route('book.details', $item->book->id) }}">
                                    {{ $item->book->title }}</a></td>
                            <td>{{ $item->book->author->name }}</td>
                            <td>
                                @foreach ($item->book['genres'] as $genre)
                                    <a href="{{ route('book.details', $item->id) }}"
                                        class="btn btn-outline-info btn-sm waves-effect waves-light">
                                        {{ $genre->name }}</a>
                                @endforeach
                            </td>
                            <td>{{ $item->book->rating() }}</td>
                            @php
                                $review = App\Models\Review::getThisReview($user, $item->book->id);
                            @endphp
                            <td class="text-nowrap">
                                <div class="rating-star">
                                    <input type="hidden" class="rating mylibrary" data-filled="mdi mdi-heart text-danger"
                                        data-empty="mdi mdi-heart-outline text-danger"
                                        value="{{ $review ? $review->rating : 0 }}" />
                                    <input type="hidden" value="{{ $item->book->id }}">
                                    <div style="display:none"
                                        class="spinner-border spinner-border-sm text-success myspinner" role="status">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('delete.reading.book', $item->id) }}" class="btn btn-danger sm"
                                    title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
                                <button type="button" class="btn btn-outline-secondary btn-rounded waves-effect"
                                    data-bs-toggle="modal" data-bs-target="#AddLibraryModal"
                                    data-bs-book_id="{{ $item->book->id }}">
                                    <i class="fas fa-check"></i> {{ $item->status }}
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
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
