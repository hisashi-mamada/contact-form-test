<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @if(request()->is('admin*'))
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @elseif(request()->is('register'))
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    @elseif(request()->is('login'))
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @endif
</head>

<body>
    <header>
        <h1 class="site-title">FashionablyLate</h1>

    </header>
    <div class="header-line"></div>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; 2025 mysite</p>
    </footer>
</body>

</html>
