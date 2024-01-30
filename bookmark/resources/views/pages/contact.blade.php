@extends('layouts/main')

@section('title')
    Contact
@endsection

@section('content')
    <h1>Contact</h1>
    <p>Questions? Email us at {{ config('mail.contact_email') }}.</p>
@endsection