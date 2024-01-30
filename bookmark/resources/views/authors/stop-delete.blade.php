@extends('layouts/main')

@section('head')
<link href='/css/authors/delete.css' rel='stylesheet'>
@endsection

@section('title')
Can not delete {{ $author->getFullname() }}
@endsection

@section('content')

<h1>Can not delete {{ $author->getFullname() }} </h1>

<p>The author <strong>{{ $author->getFullname() }}</strong> is currently connected to the following books:</p>

<div id='books'>
@foreach($books as $book)
    <a href='/books/{{ $book->slug }}'><img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'></a>
@endforeach
</div>

<p><strong>Please delete these books first before attempting to delete this author.</strong></p>

<a href='/authors'>← Return to authors</a>


@endsection
