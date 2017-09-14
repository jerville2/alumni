<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <style>
        .navi{
            background: floralwhite;
            position: fixed;
        }
        .b{
           background: lightslategrey;
        }
    </style>
   <script>
       $('document').ready(function () {

           $(window).scroll( function() {
           /*     var lim=10;

                    $("nav").toggleClass("navbar-fixed-top",$(this).scrollTop()>=lim);
                    $('#navi').toggleClass("affix",$(this).scrollTop()>=lim)
                    $('#cont').toggleClass("container",$(this).scrollTop()>=lim);

             console.log($(this).scrollTop())*/
           });

       });


   </script>
</head>
<body class="b">

    <div class="container">
            <br>
            <nav class="navbar  navbar-default" >
                <div class="container-fluid" id="cont">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <!-- Brand and toggle get grouped for better mobile display -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" >
                           Graduate Tracer
                        </a>

                    </div>
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">


                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/">MMSU Alumni</a></li>
                            <li><a href="http://mmsu.edu.ph/">MMSU Site</a></li>

                        </ul>
                    </div>



                </div>
            </nav>
        </div>
        <br>
        <br>
        @yield('content')
    </div>


<!-- Scripts -->



</body>
</html>
