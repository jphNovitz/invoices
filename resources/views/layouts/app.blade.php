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
<body>
<div id="app">
    <nav class="w-full flex flex-col md:flex-row justify-between p-6 bg-slate-700 text-slate-50">
        <ul class="flex flex-row items-center justify-between">
            <li class="mx-3 text-2xl font-black">Mes factures</li>
            <li id="toggle"
                class="mx-3 md:hidden bg-slate-500 p-2 cursor-pointer">
                <i class="fas fa-bars fa-2x"></i>
            </li>
        </ul>
        <ul class="menu-group">
            <li class="mx-3 pt-6 md:pt-0 nav-link">
                <a href="{{route('home')}}">{{__('app.Home')}}</a>
            </li>
            <li class="px-3 nav-link"><a href="{{route('invoices_list')}}">{{__('app.My_invoices')}}</a></li>
            <li class="px-3 nav-link"><a href="{{route('clients_list')}}">{{__('app.My_clients')}}</a></li>
            <li><a href=""></a></li>
        </ul>
        @auth
            <ul class="md:mt-0 h-0  menu-group">
                <li class=" mx-3 ">
                    <a href="{{route('user_home')}}"
                       class="">
                        {{\auth()->getUser()->firstname}}
                    </a>
                </li>
                <li class="mx-3">(<a href="{{route('home')}}">{{__('auth.logout')}}</a>)</li>
            </ul>
        @endauth
    </nav>

    <main class="m-6">
        <?php
        /**
         * @todo externaliser vers un fichier séparé et faire un include
         */
        ?>
        <aside>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @elseif(session()->has('alert-success'))
                <div class="alert alert-success">
                    {{ session()->get('alert-success') }}
                </div>
            @elseif(session()->has('alert-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('alert-danger') }}
                </div>
            @endif
        </aside>
        @yield('content')
    </main>
    <footer>
        (2022) <a href="https://jphnovitz.be"> Novitz Jean-Philippe, Développeur Web à Liège </a>
    </footer>
</div>
</body>
</html>
