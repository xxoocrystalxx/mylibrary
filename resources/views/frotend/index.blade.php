@php
$books = App\Models\Book::orderByRating()
    ->limit(5)
    ->get();
$latest = App\Models\Book::latest()
    ->limit(5)
    ->get();
$genres = App\Models\Genre::orderBy('name', 'ASC')->get();
@endphp
@extends('home.frotend')
@section('title')
    Home | My Library
@endsection
@section('main')
    <div class="page-content">
        <div class="container-fluid">

            <div class="mybox">
                <h3 class="mytitle"><i class="fas fa-fire text-danger"></i> BestSeller</h3>
                <div class="newnovels">
                    <ul>
                        @foreach ($books as $item)
                            <li>
                                <a href="{{ route('book.details', $item->id) }}">
                                    <div class="book-image">
                                        <img
                                            src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="mybox">
                <h3 class="mytitle"><i class="mdi mdi-bullhorn text-danger"></i> News Releases</h3>
                <div class="newnovels">

                    <ul>
                        @foreach ($latest as $item)
                            <li>
                                <a href="{{ route('book.details', $item->id) }}">
                                    <div class="book-image">
                                        <img
                                            src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="row genreList">
                <ul class="row-xl-2">
                    @foreach ($genres as $item)
                        <li class=""><a class="underline"
                                href="{{ route('genre.details', $item->id) }}">{{ $item->name }} <span
                                    class="badge rounded-pill badge-soft-dark mybadge">{{ $item->books->count() }}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
