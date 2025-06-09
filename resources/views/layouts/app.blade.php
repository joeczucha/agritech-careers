<html>

<head>
    <title>App Name - @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('partials.header')

    @yield('content')

    @include('partials.footer')
</body>

</html>
