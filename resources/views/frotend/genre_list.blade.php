@extends('home.frotend')
@section('title')
    Genre List | My Library
@endsection
@section('main')
    <div class="page-content">
        <div class="row genreList">
            <h3 class="mytitle">All Genres</h3>
            <ul class="row-xl-2">
                @foreach ($genres as $item)
                    <li class=""><a class="underline" href="{{ route('genre.details', $item->id) }}">{{ $item->name }}
                            <span class="badge rounded-pill badge-soft-dark mybadge">{{ $item->books->count() }}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
