<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DOCTORS - Gestion des Réservations</title>
    <!-- Favicon icon -->
    <link rel="icon" href="/assets/images/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-48x48.png" sizes="48x48" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-64x64.png" sizes="64x64" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-96x96.png" sizes="96x96" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-128x128.png" sizes="128x128" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-160x160.png" sizes="160x160" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-192x192.png" sizes="192x192" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-195x195.png" sizes="195x195" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-196x196.png" sizes="196x196" type="image/png">
    <link rel="icon" href="/assets/images/favicons/favicon-228x228.png" sizes="228x228" type="image/png">

    <link rel="apple-touch-icon" href="/assets/images/favicons/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicons/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/favicons/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/favicons/touch-icon-ipad-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/assets/images/favicons/touch-icon-ipad-pro.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicons/touch-icon-iphone-6plus.png">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/188222bc05.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="app">
        <div class="wrapper">
            @include('layouts.partials.navbar')
            @guest
                <div class="main-content py-5 w-auto">
                    @yield('content')
                </div>
            @else
                @include('layouts.partials.sidebar')
                <div class="main-content py-4">
                    @yield('content')
                </div>
            @endguest
            @include('layouts.partials.footer')   
        </div>
    </div>
</body>
</html>