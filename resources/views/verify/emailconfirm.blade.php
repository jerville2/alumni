@extends('layouts.app')
@section('carousel')
    <div class="carousel"></div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="panelcolor">Registration Confirmed</div>
                <div class="panel-body">
                    Your Email is successfully verified. Click here to <a href="{{url('/login')}}"><strong>Login</strong></a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection