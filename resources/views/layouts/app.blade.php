<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.analytics');

    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">

    <title>Careers at Agritech &amp; Forage products | {{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body>
    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @livewire('notifications')

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
