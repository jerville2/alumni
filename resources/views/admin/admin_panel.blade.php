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
    <style>
        strong{
            font-weight:bold; font-size:12px;
        }
        i{
            font-size: 12px;
        }
        .nav-sidebar {
            border-bottom: none;
            padding-top: 2px;
        }
        .nav-sidebar {
            border-right: 1px solid #ddd;
        }
        .nav-sidebar>li{
            float: none;
            margin-bottom: 2px;
        }
        .nav-sidebar>li {
            margin-right: -1px;
        }
        .nav-sidebar>li>a {
            border-radius: 0;
            margin-right: 0;
            display:block;
        }
        .nav.nav-sidebar { border-right: 2px solid #DDD; }
        .nav.nav-sidebar > li.active > a, .nav > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
        .nav.nav-sidebar > li > a { border: none; color: white; }
        .nav.nav-sidebar > li.active > a, .nav > li > a:hover { border-right:4px solid #004100 !important; background: whitesmoke; color: #004100;}
        .nav.nav-sidebar > li > a::after { content: ""; border-right:4px solid #004100; height: 0px; position: absolute; width: 100%; top: 0px; right: -1px; transition: all 250ms ease 0s; transform: scale(0); }
        .nav.nav-sidebar > li.active > a::after, .nav > li:hover > a::after { transform: scale(1); }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
    </script>
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
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-container">
                            <div class="dropdown-toolbar">
                                <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count"></span>)</h3>
                            </div>
                            <ul class="dropdown-menu">
                                @foreach(\App\Post::where('report',1)->get() as $post)
                                    <li class="notification active">
                                        <div class="media">
                                            <a href="/admin/post/view/{{ $post->id }}">
                                                <div class="media-body">
                                                    <strong class="notification-title">{{ $post->rname }}</strong>
                                                    <p class="notification-desc">{{ $post->rname }} has reported a post</p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="dropdown-footer text-center">
                                <a href="{!! url('admin/post') !!}">View All</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/" style="font-weight: 500; color: white" target="_blank"><i class="glyphicon glyphicon-backward"></i> Back to Site</a>
                    </li>
                    @if (Auth::check())
                        <notifications-dropdown></notifications-dropdown>
                    @endif
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
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar" style="background: #839393; font-weight: 600; color: white">
                <div class="page-header"><h4>Admin Panel</h4></div>
                <ul class="nav nav-sidebar" role="tablist" id="myTabs" style="">
                    <li class="{{ $galleries or ''}}"><a href="{!! url('admin/galleries') !!}">Images</a></li>
                    <li class="{{ $s or ''}}"><a href="{!! url('admin/slides') !!}">Slide show image</a></li>
                    <li class="{{ $f or '' }}"><a href="{!! url('admin/files') !!}">Files</a></li>
                    <li class="{{ $n or '' }}"><a href="{!! url('admin/news') !!}">News</a></li>
                    <li class="{{ $e or '' }}"><a href="{!! url('admin/events') !!}">Events</a></li>
                    <li class="{{ $a or '' }}"><a href="{!! url('admin/announcements') !!}">Announcements</a></li>
                    <li class="{{ $o or '' }}"><a href="{!! url('admin/opportunities') !!}">Jobs/opportunities</a></li>
                    <li class="{{ $r or '' }}"><a href="{!! url('admin/reunions') !!}">Reunions</a></li>
                    <hr>
                    <li class="{{ $u or '' }}"><a href="{!! url('admin/users') !!}">Users</a> </li>
                    <li class="{{ $p or '' }}">
                        <a href="{!! url('admin/post') !!}">
                            Reported Post <i data-count="{{ \App\Post::where('report', 1)->count() }}" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>
                    </li>
                    <hr>
                    <li class="{{ $c or '' }}"><a href="{!! route('category.index') !!}">GTS</a> </li>
                    <li class="{{ $ca or '' }}"><a href="{!! route('report.index') !!}">GTS Report</a> </li>
                    <li class="dropdown {{ $m or '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Migrate <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" style="margin-bottom: 20px">
                            <li>
                                <a href="{{ route('migrateChoices.index') }}">Add Choices</a>
                            </li>
                            <li>
                                <a href="{{ route('answersM.index') }}">Add Answers</a>
                            </li>
                            <li>
                                <a href="{{ route('profSkillsM.index') }}">Migrate Prof Skills</a>
                            </li>
                            <li>
                                <a href="{{ route('trainingsM.index') }}">Migrate Trainings</a>
                            </li>
                            <li>
                                <a href="{{ route('educM.index') }}">Migrate Educational Background</a>
                            </li>
                            <li>
                                <a href="{{ route('examM.index') }}">Migrate Prof. Exams</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('admin')
            </div>
        </div>
    </div>

    <nav class="navbar  navbar-fixed-bottom" style="background: #111111; ">
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
<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script type="text/javascript">

    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.dropdown-menu');

    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }

    var pusher = new Pusher("{{env("PUSHER_APP_KEY")}}", {
        cluster: 'ap1',
        encrypted: true
    });
    var channel = pusher.subscribe('post-reported');

    channel.bind('new_report', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
              <a href="/admin/post/view/`+data.postId+`">
                <div class="media-body">
                  <strong class="notification-title">`+data.username+`</strong>
                    <p class="notification-desc">`+data.message+`</p>
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

@include('sweet::alert')
@yield('fs')
</body>
</html>
