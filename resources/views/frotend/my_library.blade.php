@extends('home.frotend')
@section('title')
    My Library
@endsection
@section('main')
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
                            <td><a href="{{ route('author.details', $item->id) }}">{{ $item->book->author->name }}</a></td>
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
    @include('frotend.components.addMyLibraryModal')
@endsection
