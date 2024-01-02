<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SIPETA">
    <meta name="author" content="SIPETA">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name', 'Kartu Kontrol') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    @stack('css')
    <style>
        ::-webkit-scrollbar {
            width: 10px
        }

        ::-webkit-scrollbar-track {
            background: #eee
        }

        ::-webkit-scrollbar-thumb {
            background: #888
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555
        }

        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main {
            background-color: #eee;
            width: 100%;
            position: relative;
        }

        .scroll {
            overflow-y: scroll !important;
            scroll-behavior: smooth !important;
            height: 80vh !important;
        }

        .name {
            font-size: 10px
        }

        .read {
            font-size: 10px
        }

        .msg {
            background-color: #fff;
            font-size: 14px;
            padding: 5px;
            border-radius: 5px;
            font-weight: 500;
            color: #3e3c3c
        }
    </style>
</head>
