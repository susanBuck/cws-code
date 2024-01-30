@extends('layouts/main')

@section('title')
Authors
@endsection

@section('head')
<link href='/css/authors/index.css' rel='stylesheet'>
@endsection

@section('content')

<h1>Authors</h1>

<div id='authors'>
    @foreach($authors as $author)
    <div class='author'>
    <h2>{{ $author->first_name }} {{ $author->last_name }}</h2>

    <a class='deleteLink' href='/authors/{{ $author->id }}/delete'><i class="fa fa-trash"></i> Delete Author</a>
   
    @foreach($author->books as $book)
        <a href='books/{{ $book->slug }}'><img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'></a>
    @endforeach
    

  
    </div>
    @endforeach
</div>


@endsection
