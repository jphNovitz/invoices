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
<body class="bg-auth bg-cover flex flex-col h-screen">
<header class="text-slate-50 ml-12 mt-12 ">
    <h1 class="text-4xl font-black uppercase">
        Factures
    </h1>
</header>
<main class="w-full h-screen flex  justify-center  items-center md:justify-end md:items-end font-body">
    <div id="app" class="flex md:mr-12 md:mb-12 p-0 w-min bg-transparent">

        @yield('content')
    </div>
</main>
<footer class="text-center text-slate-50">
    (2022) <a href="https://jphnovitz.be"> Novitz Jean-Philippe, Développeur Web à Liège </a>
</footer>
</body>
</html>