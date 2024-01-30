@extends('layouts/main')

@section('title')
Add {{ $book->title }} to your list
@endsection

@section('content')
<h1>Add to your list</h1>
<h2>{{ $book->title }}</h2>

<form method='POST' action='/list/{{ $book->slug }}/save'>
    {{ csrf_field() }}

    <label for='notes'>YOUR NOTES ON THIS BOOK</label>
    <textarea name='notes' test='notes-textarea'>{{ old('notes') }}</textarea>

    <button type='submit' test='add-to-list-button' class='btn btn-primary'>Add to your list</button>
</form>
@endsection
