@extends('layouts/main')

@section('head')
<link href='/css/authors/delete.css' rel='stylesheet'>
@endsection

@section('title')
Confirm deletion: {{ $author->getFullname() }}
@endsection

@section('content')

<h1>Confirm deletion</h1>

<p>Are you sure you want to delete the author <strong>{{ $author->getFullname() }}</strong>?</p>

<form method='POST' action='/authors/{{ $author->id }}'>
    {{ method_field('delete') }}
    {{ csrf_field() }}
    <button type='submit' test='confirm-delete-button' class='btn btn-danger btn-small'>Yes, delete them!</button>
</form>

<p id='cancel'>
    <a href='/authors'>No, I changed my mind.</a>
</p>

@endsection
