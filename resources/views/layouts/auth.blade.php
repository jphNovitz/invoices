<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body id="auth-page">
<header>
    <h1>Factures</h1>
    <nav>
        @if(Request::segment(1) === 'register')
            <a href="{{route('login')}}" class="font-black" >{{__('auth.Login')}} </a>
        @else <a href="{{route('register')}}" class="font-black" >{{__('auth.Register')}} </a>
        @endif
    </nav>
</header>

<main>
    <div id="app">
        @yield('content')
    </div>
</main>

<footer>
    (2022) <a href="https://jphnovitz.be"> Novitz Jean-Philippe, Développeur Web à Liège </a>
</footer>
</body>
</html>