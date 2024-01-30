@extends('layouts/main')

@section('head')
<link href='/css/books/delete.css' rel='stylesheet'>
@endsection

@section('title')
Confirm deletion: {{ $book->title }}
@endsection

@section('content')

<h1>Confirm deletion</h1>

<p>Are you sure you want to delete <strong>{{ $book->title }}</strong>?</p>

<form method='POST' action='/books/{{ $book->slug }}'>
    {{ method_field('delete') }}
    {{ csrf_field() }}
    <button type='submit' test='confirm-delete-button' class='btn btn-danger btn-small'>Yes, delete it!</button>
</form>

<p class='cancel'>
    <a href='/books/{{ $book->slug }}'>No, I changed my mind.</a>
</p>

@endsection
