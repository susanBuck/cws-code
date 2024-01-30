@extends('layouts/main')

@section('head')
<link href='/css/authors/delete.css' rel='stylesheet'>
@endsection

@section('title')
Confirm deletion {{ $author->getFullname() }}
@endsection

@section('content')

<h1>Confirm deletion {{ $author->getFullname() }} </h1>

<p>The author <strong>{{ $author->getFullname() }}</strong> is currently connected to the following books:</p>

<div id='books'>
@foreach($books as $book)
    <a href='/books/{{ $book->slug }}'><img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'></a>
@endforeach
</div>

<p><strong>If you delete this author, the above books will also be deleted. Are you sure you want to continue?</strong></p>

<form method='POST' action='/authors/{{ $author->id }}'>
    {{ method_field('delete') }}
    {{ csrf_field() }}
    <button type='submit' test='confirm-delete-button' class='btn btn-danger btn-small'>Yes, delete them!</button>
</form>

<p id='cancel'>
    <a href='/authors'>No, I changed my mind.</a>
</p>


@endsection
