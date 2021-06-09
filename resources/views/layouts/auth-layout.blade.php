<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SwissGuesser') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/vue.js') }}" defer></script>

    <!-- External styles -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Internal styles -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo/favicon.png') }}" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body class="gradient-background">
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
