<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/uploads/articles/mmsuLogo.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/notification.css') }}" rel="stylesheet">
    @yield('hs')

</head>
<body>
<div id="app">
    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar navbar-green navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button style="background: white" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- BrandImgmage -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <span><img alt="Brand" src="{{ asset('storage/uploads/articles/mmsuLogo.png') }}" width="35px" style="margin-top: -7px; margin-bottom: -5px;"></span>
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <div class="container">
                            <!-- Left Side Of Navbar -->
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">About Us</a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/about_us">Mission and Objectives</a></li>
                                        <li><a href="/about_us/organization">Organizational Structure</a></li>
                                        <li><a href="/about_us/coordinators">Coordinators</a></li>
                                        <li><a href="/about_us/faai">FAAI Officers</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Services</a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/services">Balik-Alumni</a></li>
                                        <li><a href="/services/idcard">Alumni ID Card</a></li>
                                    </ul>
                                </li>
                                <!--<li><a href="#">Services</a> </li>-->
                                <li><a href="/reunions">Homecoming</a> </li>
                                <li><a href="/news">News</a> </li>
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <div class="container">
                                        <form action="/q" method="get" class="search-form">
                                            <div class="form-group has-feedback">
                                                <label for="search" class="sr-only">Search</label>
                                                <input type="text" class="form-control" name="search" id="search" placeholder="search">
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                            </div>
                                        </form>
                                    </div>
                                </li>

                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                    <li >
                                        <p class="navbar-btn">
                                            <a href="{{ route('login') }}" class="btn-nav">
                                                <span style="font-weight: 700">My Account</span>
                                            </a>
                                        </p>
                                    </li>
                                @else
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span>
                                                @if(Auth::user()->picture == null)
                                                    <img class="img-circle" width="30" height="30" src="{{ asset('storage/uploads/imgs/default.png') }}" style="margin-top: -10px; margin-bottom: -10px">
                                                @else
                                                    <img class="img-circle" width="35" height="35" src="{{ asset('storage'.Auth::user()->picture->location) }}" style="margin-top: -10px; margin-bottom: -10px">
                                                @endif
                                            </span>

                                            @if(Auth::user()->alumni->middlename == null)
                                                {{ Auth::user()->alumni->firstname.' '.Auth::user()->alumni->surname }}
                                                <span class="caret"></span>
                                            @else
                                                {{ Auth::user()->alumni->firstname.' '.substr(Auth::user()->alumni->middlename, 0, 1).'. '.Auth::user()->alumni->surname }}
                                                <span class="caret"></span>
                                            @endif

                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="/my_profile"><span><i class="glyphicon glyphicon-user"></i></span> My Profile</a>
                                                <a href="/alumni/home"><span><i class="glyphicon glyphicon-level-up"></i> </span> Directory</a>
                                                @if(Auth::user()->admin == 1)
                                                    <a href="/admin/news"><span><i class="glyphicon glyphicon-lock"></i></span> Admin Panel</a>
                                                @endif
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <span><i class="glyphicon glyphicon-log-out"></i> </span>
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
        @yield('content')
    </div>
    @yield('carousel')

    @yield('myprofile')


    <div class="container">
        <hr class="featurette-divider">

        <footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2017 Mariano Marcos State University. All Rights Reserved.</p>
        </footer>
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('js/select-filtering.js')}}"></script>

<script src="{{ asset('js/sweetalert.min.js') }}"></script>
@include('sweet::alert')
@yield('fs')
</body>
</html>
