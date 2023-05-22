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
    <header class="overflow-hidden flex p-6 flex-col md:flex-row-reverse relative border-2 bg-slate-100 border-blue-800 text-blue-800 rounded-lg">
        {{--        <article class="w-full md:w-1/2 border border-2 border-blue-600 rounded-lg shadow-lg shadow-blue-300">--}}
        <figure class=" bg-hero-mobile md:bg-hero-md  bg-center lg:bg-center w-full sm:w-full md:w-[45vw] lg:w-[50vw]  aspect-video lg:aspect-video md:aspect-square absolute  top:0 m-auto left-0 right-4 md:left-auto md:right-6 md:top-50 bg-no-repeat bg-cover lg:bg-content z-0"></figure>
        {{--        </article>--}}

        <article
                class="w-full pt-[41vh] sm:pt-[51vh] md:pt-0 md:pb-12  md:pr-[38vw] lg:pr-[50vw] z-20 flex flex-col-reverse md:flex-col bg-slate-100/50">
            <div>
                <x-title.h2> Gestion des factures et des clients</x-title.h2>
                <p class="text-lg">
                    Un site de gestion des factures et des clients est une plateforme en ligne qui permet aux
                    entreprises de
                    gérer leur facturation et de suivre les informations de leurs clients de manière efficace.
                </p>
            </div>
            <nav class="flex justify-center my-12">
                <x-button.primary route="{{ route('login') }}" label="{{__('auth.Login')}}" class="mr-1.5"/>
                <x-button.secondary route="{{ route('register') }}" label="{{__('auth.Register')}}" class="ml-1.5"/>
            </nav>
        </article>

    </header>


    <article class="mt-12 mb-6 text-blue-900 md:flex">
        <figure class="flex items-center justify-center md:w-1/3">
            <img src="./img/illustration-profile.jpg" alt="invoices - gestion profile" class="w-1/2 md:w-auto">
        </figure>
        <div class="flex md:w-2/3 flex-col md:justify-center">
            <x-title.h2>Gestion du Profile</x-title.h2>
            <p class="md:text-lg">
                Notre plateforme vous offre la possibilité de créer, modifier et supprimer votre profil en quelques
                clics.
                Vous pouvez personnaliser vos informations, mettre à jour vos coordonnées pour vous
                assurer que votre profil est toujours à jour.
            </p>
        </div>
    </article>

    <article class="mt-12 mb-6 text-blue-900 flex flex-col-reverse md:flex-row">
        <div class="flex md:w-2/3 flex-col md:justify-center">
            <x-title.h2>Gestion des Clients</x-title.h2>
            <p>
                La gestion des clients est également facilitée sur notre site. Vous pouvez ajouter de nouveaux clients,
                enregistrer leurs informations importantes et les mettre à jour au besoin. Grâce à notre interface
                conviviale, vous pouvez facilement naviguer entre les profils des clients, accéder à leur historique.
            </p>
        </div>
        <figure class="flex items-center justify-center md:w-1/3">
            <img src="./img/illustration-client.jpg" alt="invoices - gestion client" class="w-1/2 md:w-auto">
        </figure>
    </article>

    <article class="mt-12 mb-6 text-blue-900 flex flex-col md:flex-row">
        <figure class="flex items-center justify-center md:w-1/3">
            <img src="./img/illustration-invoice.jpg" alt="invoices - gestion facture" class="w-1/2 md:w-auto">
        </figure>

        <div class="flex md:w-2/3 flex-col md:justify-center">
            <x-title.h2>Gestion des Factures</x-title.h2>
            <p>
                La gestion des factures est un jeu d'enfant avec notre système. Vous pouvez créer des factures
                professionnelles en quelques instants, y ajouter tous les détails nécessaires. Si vous avez besoin de
                modifier une facture existante ou d'annuler une facture en cas de
                besoin, vous pouvez le faire facilement grâce à notre fonctionnalité de modification et d'annulation des
                factures.
            </p>
        </div>
    </article>
    <article class="my-12 text-blue-900 font-black">
        Nous sommes ravis de vous offrir ces fonctionnalités pratiques pour vous aider à gérer votre profil, vos clients
        et vos factures de manière efficace. Naviguez sur notre site et découvrez comment nous pouvons simplifier votre
        gestion au quotidien !
    </article>
</main>
</body>
</html>
