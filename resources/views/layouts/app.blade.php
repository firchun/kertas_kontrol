<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kertas Kontrol') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- add css  --}}
    @stack('style')
    <style>
        .underline-half {
            position: relative;
            display: inline-block;
        }

        .underline-half::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 120%;
            /* Atur lebar garis bawah di sini, 50% dari panjang keseluruhan */
            height: 3px;
            /* Atur ketebalan garis bawah di sini */
            background-color: #F9690E;
            /* Atur warna garis bawah di sini */
        }

        .underline-center {
            position: relative;
            display: inline-block;
            text-align: center;
            /* Pusatkan teks */
        }

        .underline-center::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            /* Pusatkan garis bawah */
            width: 50%;
            /* Sesuaikan lebar sesuai keinginan Anda */
            height: 5px;
            background-color: #F9690E;
        }

        .zoom-hover {
            overflow: hidden;
            position: relative;
        }

        .zoom-hover img {
            transition: transform 0.3s;
            /* Transisi efek zoom */
        }

        .zoom-hover:hover img {
            transform: scale(1.1);
            /* Efek zoom saat dihover */
        }

        .gradient-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80%;
            /* Tinggi gradient */
            background: linear-gradient(to top, rgba(0, 0, 0, 0.582), rgba(0, 0, 0, 0));
            pointer-events: none;
        }

        .floating-button {
            justify-content: center;
            display: flex;
            align-items: center;
            /* line-height: 46PX; */
            text-align: center;
            height: 60px;
            width: 60px;
            position: fixed;
            bottom: 50px;
            right: 50px;
            background-color: #f25601;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
        }

        .floating-button a {

            color: #ffffff;
            text-decoration: none;
            text-align: center;
            /* color: #F9690E; */
        }

        .badge-top-right {
            position: absolute;
            top: 0;
            right: 0;
        }

        /* chat */
        .chat_box {
            background: #fff;
            width: 400px;

            height: 435px;
            position: fixed;
            bottom: 0px;
            right: 14px;
            border: none;
            border-radius: 5px 5px 0 0;
            -webkit-box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
            -moz-box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
            box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
            overflow: hidden;
            z-index: 1000000;
            display: none
        }

        /* Media query for mobile devices */
        @media (max-width: 767px) {
            .chat_box {
                width: 100%;
                right: 0;
                left: 0;
                border-radius: 0;
            }
        }

        .pesan_chat {
            text-align: center;
            text-decoration: none;
            display: block;
            height: 100%;
            padding: 5px 5px 15px
        }

        .chatheader {
            margin: 0 auto;
            padding: 0 10px;
            height: 35px;
            line-height: 35px;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            text-align: left;
            display: block;
            cursor: pointer;
            background: #f25601;
        }

        .pesan_chat p {
            color: #616161;
            font-size: 14px;
            margin: 10px
        }

        .close-chatfb {
            position: absolute;
            top: 0;
            right: 0;
            font-family: Arial;
            font-size: 24px;
            font-weight: 700;
            cursor: pointer;
            width: 24px;
            color: #fff;
            height: 35px;
            line-height: 35px;
            text-align: center;
            opacity: .7
        }

        .close-chatfb:hover,
        .maxi-chatfb:hover,
        .mini-chatfb:hover {
            opacity: 1
        }

        .round.hollow {
            margin: 40px 0 0;
        }

        .round.hollow a {
            border: 2px solid #2c4584;
            border-radius: 35px;
            color: #2c4584;
            font-size: 23px;
            padding: 10px 21px;
            text-decoration: none;
            font-family: 'Open Sans', sans-serif;
        }

        .round.hollow a:hover {
            border: 2px solid #138be6;
            border-radius: 35px;
            color: red;
            color: #000;
            font-size: 23px;
            padding: 10px 21px;
            text-decoration: none;
        }

        .popup-box-on {
            display: block !important;
        }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
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
    </div>
</body>

</html>
