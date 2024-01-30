@extends('layouts/main')

@section('head')
<link href='/css/lists/show.css' rel='stylesheet'>
@endsection

@section('title')
Your List
@endsection

@section('content')

@if($books->count() == 0)
    <p test='no-books-message'>You have not added any books to your list yet.</p>
    <p><a href='/books'>Find books to add in our library...</a></p>
@else

    @foreach($books as $book)
        <div class='book'>
            <a href='/books/{{ $book->slug }}'>
                <h2>{{ $book->title }}</h2>
            </a>

            @if($book->author)
            <p>By {{ $book->author->first_name. ' ' . $book->author->last_name }}</p>
            @endif

            {{-- In the following code, observe how `$book->pivot` is used to access 
            details (`created_at` and `notes`) from the book to user relationship --}}
            
            <form method='POST' action='/list/{{ $book->slug }}/update'>
                {{ csrf_field() }}
                {{ method_field('put') }}
                <textarea class='notes' name='notes' test='{{ $book->slug }}-notes-textarea'>{{ $book->pivot->notes }}</textarea>
                <button type='submit' class='btn btn-primary' test='{{ $book->slug }}-update-button'>Update notes</button>
            </form>

            <p class='added'>
                Added {{ $book->pivot->created_at->diffForHumans() }}
            </p>

            @include('includes/remove-from-list')
        </div>
    @endforeach

@endif

@endsection