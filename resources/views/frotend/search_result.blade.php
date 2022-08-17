@extends('home.frotend')
@section('title')
    Search Result for "{{ $value }}" | My Library
@endsection
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <div class="row">
            <table class="table mb-0 table-hover">
                <thead class="table-info">
                    <h4 class="mytitle"><i class="fas fa-search"></i> Search Result for '{{ $value }}'</h4>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        <tr>
                            <td>
                                <div class="myitem genre-img-box">
                                    <div class="book-image">
                                        <a href="{{ route('book.details', $item->id) }}"><img
                                                src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td><a class="underline" href="{{ route('book.details', $item->id) }}">
                                    {{ $item->title }}</a> by {{ $item->author->name }}
                                <div class="d-none d-sm-block">
                                    <p class="genre-desc">
                                        {!! Str::limit($item->description, 200) !!}</p>
                                </div>
                                <div class="d-sm-block">
                                    @foreach ($item->genres as $genre)
                                        <a href="{{ route('book.details', $item->id) }}"
                                            class="btn btn-outline-info btn-sm waves-effect waves-light">
                                            {{ $genre->name }}</a>
                                    @endforeach
                                </div>
                            </td>

                            <td class="text-nowrap d-none d-sm-block">
                                <div class="rating-star">
                                    <input type="hidden" class="rating" data-filled="mdi mdi-heart text-danger"
                                        data-empty="mdi mdi-heart-outline text-danger" value="{{ $item->rating() }}"
                                        disabled="disabled" /><span class="badge bg-info">{{ $item->rating() }}</span>
                                </div>
                            </td>
                            @php
                                $isInMyLibrary = $user ? $user->mylibrary->where('book_id', $item->id)->first() : null;
                                
                            @endphp
                            <td class="text-nowrap">
                                <button type="button" class="btn btn-outline-secondary btn-rounded waves-effect"
                                    data-bs-toggle="modal" data-bs-target="#AddLibraryModal"
                                    data-bs-book_id="{{ $item->id }}">
                                    @if ($isInMyLibrary)
                                        <i class="fas fa-check"></i> {{ $isInMyLibrary->status }}
                                    @else
                                        Add to
                                        My
                                        Library
                                    @endif
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
