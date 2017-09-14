@extends('layouts.app')

@section('carousel')
    <div class="carousel-profile"></div>
    <div class="carousel-login"></div>
    @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="carousel-small"></div>
            <div class="page-header col-md-11" style="color: white">
                <h2>Welcome!</h2><br>
                <p>You will need an MMSU Alumni account to continue.</p>
                <a href="{{ route('register') }}" class="btn-sec">Register</a>
            </div>
            <div class="panel-body" style="color: white">
                <h3>MMSU Alumni Resources</h3><br>
                <p style="font-size: large">By signing in you'll be able to access:</p>
                <ul style="list-style: none; font-size: large">
                    <li>
                        <i class="glyphicon glyphicon-tasks"></i>
                        Online Surveys
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-list-alt"></i>
                        Job Board
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-save"></i>
                        Downloads
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-list"></i>
                        Alumni Directories
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="carousel-profile"></div>
            <div class="carousel-spacer"></div>
            <div class="card">
                <div class="panelcolor"><h4>Login</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn-main">
                                    Login
                                </button><span> | </span>
                                <a href="{{ route('register') }}">
                                    Register
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
