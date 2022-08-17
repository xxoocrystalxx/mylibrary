@extends('home.frotend')
@section('title')
    {{ $author->name }} | My Library
@endsection

@section('main')
    <div class="page-content">

        @include('frotend.components.booklist_with_details', [
            'books' => $authorbooks,
            'title' => $author->name,
        ])
    @endsection
