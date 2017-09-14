<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/uploads/articles/mmsuLogo.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="//codeorigin.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/notification.css') }}" rel="stylesheet">
    <!-- Scripts-->
    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.timeago.js') }} " type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    @yield('hs')

</head>
<body id="app-layout">
<div id="app">
    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar navbar-green navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
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
                                    <li class="dropdown dropdown-notifications">
                                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                                            <i data-count="{{ \App\Like::where([['owner', Auth::user()->id], ['viewed', 0]])->count() }}" class="glyphicon glyphicon-bell notification-icon"></i>
                                        </a>

                                        <div class="dropdown-container">
                                            <div class="dropdown-toolbar">
                                                <div class="dropdown-toolbar-actions">
                                                    <a href="/read-all" style="color: #1d1d1d">Mark all as read</a>
                                                </div>
                                                <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count"></span>)</h3>
                                            </div>
                                            <ul class="dropdown-menu">
                                                @foreach(\App\Like::latest('id')->where('owner', Auth::user()->id)->get()->take(25) as $notif)
                                                <li class="notification active">
                                                    <div class="media">
                                                        <a href="/notification/{{$notif->id}}">
                                                            <div class="media-body">
                                                                <strong class="notification-title" style="color: #1d1d1d">
                                                                    @php($user = \App\User::find($notif->reg_id)->alumni)
                                                                    {{ $user->firstname.' '.$user->middlename.' '.$user->surname}}
                                                                </strong>
                                                                <p class="notification-desc" style="color: #1d1d1d">Liked your post<small> -- <time class="timeago" datetime="{{ $notif->created_at }}"></time></small></p>
                                                                <script>
                                                                    jQuery(document).ready(function() {
                                                                        jQuery("time.timeago").timeago();
                                                                    });
                                                                </script>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <div class="dropdown-footer text-center">
                                                <a href="{!! url('my_profile/myPost') !!}" style="color: #1d1d1d">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown" style="margin-right: -12px">
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

</div>

<script type="text/javascript" src="{{asset('js/select-filtering.js')}}"></script>
<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
@if(Auth::check())
<script type="text/javascript">

    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.dropdown-menu');

    /* if (notificationsCount <= 0) {
     notificationsWrapper.hide();
     }*/

    var pusher = new Pusher("{{env("PUSHER_APP_KEY")}}", {
        cluster: 'ap1',
        encrypted: true
    });
    var channel = pusher.subscribe('{{\Illuminate\Support\Facades\Auth::user()->id}}');

    channel.bind('new_like', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
              <a href="/alumni/post/`+data.postId+`">
                <div class="media-body">
                  <strong class="notification-title" style="color: #1d1d1d">`+data.username+`</strong>
                    <p class="notification-desc" style="color: #1d1d1d">`+data.message+`</p>
                </div>
                </a>
              </div>
          </li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();

    });
</script>
@endif
@include('sweet::alert')
@yield('fs')

</body>
</html>