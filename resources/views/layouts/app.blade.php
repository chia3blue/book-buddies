<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CDN Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{ config('app.name', 'Book Buddies') }} | @yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Custom CSS --}}
    {{-- asset書くとpabulicフォルダが開ける --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="base-bg">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="h5 mb-0">{{ config('app.name', 'Book Buddies') }}</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Home --}}
                            <li class="nav-item" title="Home">
                                <a href="{{ route('index') }}" class="nav-link"><i class="fa-solid fa-house icon-sm"></i></i></a>
                            </li>

                            {{-- Create Book Post --}}
                            <li class="nav-item" title="Book Post">
                                <a href="{{ route('book.create') }}" class="nav-link"><i class="fa-solid fa-square-plus icon-sm"></i></a>
                            </li>

                            {{-- Login user name --}}
                            <li class="nav-item">
                                <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-link fs-5">{{ Auth::user()->name }}</a>
                            </li>

                            {{-- User nav --}}
                            <li class="nav-item dropdown">
                                <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                    <i class="fa-regular fa-face-smile icon-sm"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    @can('admin')
                                       {{-- Admin Controls --}}
                                        <a href="{{ route('admin.users') }}" class="dropdown-item"><i class="fa-solid fa-user-gear"></i> Admin</a>

                                        <hr class="dropdown-divider"> 
                                    @endcan
                                    {{-- Profile --}}
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item"><i class="fa-regular fa-user"></i> Profile</a>

                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
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

        {{-- left design fontawesome icons --}}
        <div class="icon-background">
            <i class="fa-solid fa-dragon"></i>
            <i class="fa-solid fa-book"></i>
            <i class="fa-solid fa-ghost"></i>
            <i class="fa-regular fa-gem"></i>
            <i class="fa-solid fa-book-open"></i>
            <i class="fa-solid fa-hat-wizard"></i>
            <i class="fa-regular fa-face-smile"></i>
            <i class="fa-solid fa-feather"></i>
            <i class="fa-solid fa-crown"></i>
        </div>               

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- Admin Menu --}}
                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->is('admin/users')? 'active' : '' }}">
                                    <i class="fa-solid fa-user"></i> Users
                                </a>
                                <a href="{{ route('admin.books') }}" class="list-group-item {{ request()->is('admin/books')? 'active' : '' }}">
                                    <i class="fa-solid fa-book"></i> Book Posts
                                </a>
                                <a href="{{ route('admin.creatures') }}" class="list-group-item {{ request()->is('admin/creatures')? 'active' : '' }}">
                                    <i class="fa-solid fa-ghost"></i> Creatures
                                </a>
                                {{-- [soon] Announcements  --}}
                                <a href="#" class="list-group-item {{ request()->is('admin/announcements')? 'active' : '' }}">
                                    <i class="fa-solid fa-bullhorn"></i> Announcements<br> [Coming Soon Feature]
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
