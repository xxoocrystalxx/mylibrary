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
            @include('frotend.components.booklist', [
                'books' => $books,
                'title' => 'BestSeller',
                'icon' => 'fas fa-fire text-danger',
            ])

            @include('frotend.components.booklist', [
                'books' => $latest,
                'title' => 'New Releases',
                'icon' => 'mdi mdi-bullhorn text-danger',
            ])

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
