<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">

    <title>@yield('title',ucwords(Route::currentRouteName()))</title>
    @yield('styles',"");

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
>
</head>
<body>
<nav id="navbar" style="z-index: 1;">
    <ul class="navbar-items flexbox-col">
        <li class="navbar-logo flexbox-left" style="color: white">
            <a class="navbar-item-inner flexbox">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 1438.88 1819.54">
                    <polygon points="925.79 318.48 830.56 0 183.51 1384.12 510.41 1178.46 925.79 318.48"/>
                    <polygon points="1438.88 1663.28 1126.35 948.08 111.98 1586.26 0 1819.54 1020.91 1250.57 1123.78 1471.02 783.64 1663.28 1438.88 1663.28"/>
                </svg>

            </a>
            {{\Illuminate\Support\Facades\Auth::user()->name}}
        </li>
        <x-menu-item name="Search" href="/post/search" icon="search-outline"></x-menu-item>
        @if(!Route::currentRouteName()=='home')
        @endif
        <x-menu-item name="Home" href="/home" icon="home-outline"></x-menu-item>
        <x-menu-item name="Posts" href="/post" icon="chatbubbles-outline"></x-menu-item>
        <x-menu-item name="Post Add" href="/post/create" icon="add-circle-outline"></x-menu-item>
        <x-menu-item name="Projects" href="#" icon="folder-open-outline"></x-menu-item>
        <x-menu-item name="Dashboard" href="#" icon="pie-chart-outline"></x-menu-item>
        <x-menu-item name="Team" href="#" icon="people-outline"></x-menu-item>
        <x-menu-item name="Support" href="#" icon="chatbubbles-outline"></x-menu-item>
        <x-menu-item name="Settings" href="/home/profile" icon="settings-outline"></x-menu-item>
        <x-menu-item name="Logout" href="/logout" icon="log-out-outline"></x-menu-item>
    </ul>
</nav>

<main id="main" class="flexbox-col container " style="z-index: -1;">
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

