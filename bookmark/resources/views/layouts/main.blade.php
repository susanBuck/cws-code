<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title')</title>
    <meta charset='utf-8'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='/css/bookmark.css' rel='stylesheet'>

    @yield('head')
</head>
<body>

@if(session('flash-alert'))
    <div class='flash-alert'>
        {{ session('flash-alert') }}
    </div>
@endif

<header>
    <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='bookmark Logo'></a>

    <nav>
        <ul>
            <li><a href='/'>Home</a></li>

            @if(Auth::user())
            <li><a href='/books'>All Books</a></li>
            <li><a href='/books/create'>Add a Book</a></li>
            <li><a href='/authors'>Authors</a></li>
            <li><a href='/list'>Your list</a></li>
            @endif

            <li>
                @if(!Auth::user())
                <a href='/login' test='login-link'>Login</a>
                @else
                <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}

                        {{-- 
                        Codeception can’t invoke our JavaScript so instead of a link that acts as a submit button, we'll use a button that's styled like a link to submit this form.
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a> --}}

                        <button type='submit' class='button-link' test='logout-button'>
                            Logout
                        </button>
                    </form>
                @endif
            </li>
        </ul>
    </nav>
</header>

<section id='main'>
    @yield('content')
</section>

<footer>
    &copy; Bookmark, Inc.
</footer>

</body>
</html>