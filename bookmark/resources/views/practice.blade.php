@extends('layouts/main')

@section('content')

    <h1>Practice</h1>
    @foreach($methods as $method)
        <a href='{{ str_replace('practice', '/practice/', $method) }}'>{{ $method }}</a><br>
    @endforeach

    {{-- Books table output --}}
    @if($books)
    
        <table class='table'>
            <tr>
                @foreach($fields as $field)
                    <th>{{$field}}</th>
                @endforeach
                
            </tr>
            
            @foreach($books as $book)
            <tr>
                @foreach($fields as $field)
                <td>{{$book->$field}}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    @endif

@endsection