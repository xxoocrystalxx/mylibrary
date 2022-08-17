@extends('home.frotend')
@section('title')
    My Reviews | My Library
@endsection
@section('main')
    <div class="page-content">
        <div class="row">
            <table class="table mb-0 table-hover">
                <thead class="table-info">
                    <tr>
                        <th scope="col">cover</th>
                        <th scope="col">Book</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Review</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $item)
                        <tr>
                            <td><img src="{{ !empty($item->book->image) ? url($item->book->image) : url('upload/no_image.jpg') }}"
                                    width="50px;" height="72px;"></td>
                            <td><a class="underline" href="{{ route('book.details', $item->book->id) }}">
                                    {{ $item->book->title }}</a> <br>
                                by <a href="{{ route('author.details', $item->id) }}">{{ $item->book->author->name }}</a>
                            </td>
                            <td>
                                {{ $item->rating }}
                            </td>
                            @php
                                $review = App\Models\Review::getThisReview($user, $item->book->id);
                            @endphp
                            <td>
                                @if ($item->comment)
                                    <b> {{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</b><br>
                                @endif
                                {{ $item->comment }}
                            </td>
                            <td><a href="{{ route('edit.review', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('delete.review', $item->id) }}" class="btn btn-danger sm"
                                    title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
