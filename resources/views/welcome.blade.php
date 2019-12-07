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
        <style>
            html, body {
                background-color: #fff;
                /*color: #000;*/
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                /*color: #;*/
                /*color: #636b6f;*/
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                line-height: 2.8rem;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Invoices
                </div>
                <div class="">
                    <p>Tu es un petit indépendant et tu vends au comptoir.
                    <br /> Tu ne fais pas des factures tous les jours !</p>

                    <p>Quand un client te demande une facture tu ne veux pas jouer avec un tableur
                     ou un traitement de texte.
                        <br />Tu sais que ces factures 'à la main' tu vas les perdres.</p>
                </div>
                <div class="links">
                    <a class="btn btn-secondary rounded"
                       href="https://laravel.com/docs">
                        <i class="fas fa-home fa-lg"></i> Accueil
                    </a>
                    <a class="btn btn-secondary rounded"
                       href="https://laravel.com/docs">
                        <i class="fas fa-info-circle fa-lg"></i> A propos
                    </a>
                    <a class="btn btn-secondary rounded"
                       href="https://laravel.com/docs">
                        <i class="fas fa-pen-square fa-lg"></i> Inscription
                    </a>

                </div>
            </div>


        </div>
    </body>
</html>
