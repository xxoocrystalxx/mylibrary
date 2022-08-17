@extends('home.frotend')
@section('title')
    {{ $genre->name }} | My Library
@endsection
@section('main')
    <div class="page-content">
        <div class="row">
            <h3 class="mytitle">{{ $genre->name }}</h3>
        </div>

        @include('frotend.components.booklist', [
            'books' => $genrebooks,
            'title' => 'News Releases of ' . $genre->name,
            'icon' => 'mdi mdi-bullhorn text-danger',
        ])

        @include('frotend.components.booklist_with_details', [
            'books' => $genrebooks,
            'title' => 'All ' . $genre->name . 'genre ordered by Rating',
        ])

    </div>
@endsection
