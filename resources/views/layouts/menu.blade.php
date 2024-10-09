@php
   $menuList = [
       [
            'name'=>'Search',
            'url'=>'/post/search',
            'image'=>'search-outline',
            'guard'=>''
       ],[
            'name'=>'Home',
            'url'=>'/home',
            'image'=>'home-outline',
            'guard'=>''
       ],[
            'name'=>'Posts',
            'url'=>'/post',
            'image'=>'chatbubbles-outline',
            'guard'=>''
       ],[
            'name'=>'Post Add',
            'url'=>'/post/create',
            'image'=>'add-circle-outline',
            'guard'=>'editor|admin'
       ],[
            'name'=>'Vote',
            'url'=>'/home/vote',
            'image'=>'list-outline',
            'guard'=>''
       ],[
            'name'=>'Vote Add',
            'url'=>'/home/vote/create',
            'image'=>'add-circle-outline',
            'guard'=>'editor|admin'
       ],[
            'name'=>'Projects',
            'url'=>'#',
            'image'=>'folder-open-outline',
            'guard'=>''
       ],[
            'name'=>'Dashboard',
            'url'=>'#',
            'image'=>'pie-chart-outline',
            'guard'=>'admin'
       ],[
            'name'=>'Users',
            'url'=>'/admin/users',
            'image'=>'people-outline',
            'guard'=>'admin'
       ],[
            'name'=>'Support',
            'url'=>'#',
            'image'=>'chatbubbles-outline',
            'guard'=>''
       ],[
            'name'=>'Settings',
            'url'=>'/home/profile',
            'image'=>'settings-outline',
            'guard'=>''
       ],[
            'name'=>'Logout',
            'url'=>'/logout',
            'image'=>'log-out-outline',
            'guard'=>''
       ]




];
function MenuGuard(string $GuardString):bool{
    if(empty($GuardString)) return true;
    $guards = explode('|',$GuardString);
    foreach ($guards as $guard){
        if($guard == \Illuminate\Support\Facades\Auth::user()->role)
            return true;
    }
    return false;
}
@endphp
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
        <li class="navbar-logo navbar-item flexbox-left" >
            <a class="navbar-item-inner flexbox">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 1438.88 1819.54">
                    <polygon points="925.79 318.48 830.56 0 183.51 1384.12 510.41 1178.46 925.79 318.48"/>
                    <polygon points="1438.88 1663.28 1126.35 948.08 111.98 1586.26 0 1819.54 1020.91 1250.57 1123.78 1471.02 783.64 1663.28 1438.88 1663.28"/>
                </svg>

            </a>
            <span class="link-text" style="color: white">  {{Auth::user()->name}}</span>
        </li>
        @foreach($menuList as $menu)
            @if(MenuGuard($menu['guard']))
                <x-menu-item name="{{$menu['name']}}" href="{{$menu['url']}}" icon="{{$menu['image']}}"></x-menu-item>
            @endif
        @endforeach

    </ul>
</nav>

<main id="main" class="flexbox-col container " style="z-index: -1;">
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

