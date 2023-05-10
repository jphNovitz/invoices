<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoices</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
</head>
<body>
{{--    Naviguation--}}
{{--    @if (Route::has('login'))--}}
{{--        <div class="top-right links">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/home') }}">Home</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}">Login</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}">Register</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}

<main class="w-full md:max-w-7xl  m-auto p-6 md:p-12">
    <x-title.h1 class="text-4xl text-blue-900"> Invoice - Demo</x-title.h1>
    <header class="overflow-hidden flex p-6 flex-col md:flex-row-reverse relative border-2 bg-slate-100 border-blue-800 rounded-lg">
{{--        <article class="w-full md:w-1/2 border border-2 border-blue-600 rounded-lg shadow-lg shadow-blue-300">--}}
            <figure class="bg-hero-mobile md:bg-hero-md w-2/3 md:w-80 md:h-full lg:w-96 aspect-video md:aspect-square absolute  top:0 m-auto left-0 right-4 md:left-auto md:right-6 md:top-50 bg-no-repeat bg-cover  z-0"></figure>
{{--        </article>--}}

        <article class="w-full pt-[30vh] pt-0 md:pb-12 md:pr-96 md:pr-[28rem] z-20 flex flex-col-reverse md:flex-col bg-slate-100/50">
            <div>
                <x-title.h2> Gestion des factures et des clients</x-title.h2>
                <p class="text-lg">
                    Un site de gestion des factures et des clients est une plateforme en ligne qui permet aux
                    entreprises de
                    gérer leur facturation et de suivre les informations de leurs clients de manière efficace.
                </p>
            </div>
            <nav class="flex justify-center md:my-12">
                <x-button.primary route="" label="test" class="mr-1.5"/>
                <x-button.secondary route="" label="test" class="ml-1.5"/>
            </nav>
        </article>

    </header>
</main>
</body>
</html>
