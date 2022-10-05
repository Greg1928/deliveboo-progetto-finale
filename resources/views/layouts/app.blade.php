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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm nav-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo/logo_picknick.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{route('admin.restaurants.index')}}">Il tuo Ristorante</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{route('admin.dishes.index')}}">I tuoi Piatti</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="color: white" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
                <div class="footer__content row">
                <div class="col-lg-2 col-sm-4">
                    <div class="mt-n1"><a class="d-inline-block align-middle" href="#"><img class="d-block mb-4" src="/img/logo/logo_picknick.png" width="150"></a></div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="">
                    <h3 class="footer__content__name">Linkedin</h3>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="https://www.linkedin.com/in/vetranogiuseppe/" target="_blank"><p>Giuseppe Vetrano</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="https://www.linkedin.com/in/andriisemenchenko/" target="_blank"><p>Andrii Semenchenko</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="https://www.linkedin.com/in/gregoriosortino/" target="_blank"><p>Gregorio Sartino</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="https://www.linkedin.com/in/giuseppe-salamone/" target="_blank"><p>Giuseppe Salamone</p></a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="">
                    <h3 class="footer__content__name">Aiuto?</h3>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>Centro di aiuto</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>Supporto</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>Contatti</p></a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="pb-2 mb-4">
                    <h3 class="footer__content__name">Seguici</h3>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>Facebook</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>Twitter</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>Instagram</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>TikTok</p></a></li>
                    </ul>
                    <ul class="footer__content__table">
                        <li class=""><a class="" href="#"><p>YouTube</p></a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <div class="pb-2 mb-4">
                    <h3 class="footer__content__name">Download la nostra app</h3>
                    <div class="download">
                        <div class="download__google download__style">
                            <a href="#">Download Google Play</a>
                        </div>
                        <div class="download__apple download__style">
                            <a href="#">Download App Store</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <hr class="hrbar">
                <div class="footer__bottom row">
                <div class="footer__bottom__left__text">© All rights reserved. Made with &hearts; by <a href="#">Class 63 Groupe 6</a></div>
                <div class="footer__bottom__right">
                    <ul class="footer__bottom__right__menu">
                    <li class="footer__bottom__right__menu__text"><a href="#">Privacy Policy</a></li>
                    <li class="footer__bottom__right__menu__text"><a href="#">Terms &amp; Conditions</a></li>
                    <li class="footer__bottom__right__menu__text"><a href="#">Cookies Policy</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>