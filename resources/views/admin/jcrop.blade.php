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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
    <link href="{{ asset('css/upload.css') }}" rel="stylesheet">
    <link href="{{ asset('css/notification.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    @yield('hs')
</head>

<body >
<div class="app">
    <nav class="navbar navbar-default navbar-fixed-top" style="background: #343434">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="font-weight: 500; color: white">MMSU Alumni Relations</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/" style="font-weight: 500; color: white" target="_blank"><i class="glyphicon glyphicon-backward"></i> Back to Site</a>
                    </li>
                    <li class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-container">
                            <div class="dropdown-toolbar">
                                <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count"></span>)</h3>
                            </div>
                            <ul class="dropdown-menu">
                            </ul>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-weight: 500; color: white">
                            @if(Auth::user()->picture == null)
                                <img class="img-circle" width="40" height="40" src="{{ asset('storage/uploads/imgs/default.png') }}" style="margin-top: -10px; margin-bottom: -10px">
                            @else
                                <img class="img-circle" width="40" height="40" src="{{ asset('storage'.Auth::user()->picture->location) }}" style="margin-top: -10px; margin-bottom: -10px">
                            @endif

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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        @yield('admin')
    </div>

    <nav class="navbar  navbar-fixed-bottom" style="background: #111111">
        <div class="container-fluid">
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left" style="padding-top: 10px; color: white">
                    <li>
                        © 2017 Mariano Marcos State University. All Rights Reserved.
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster-->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

@include('sweet::alert')
@yield('fs')
</body>
</html>
