@extends('layouts.app')
@section('carousel')
    <div class="carousel"></div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div style="background:linear-gradient(to right, #ffcc5e 50%, #ffae00); color: #8c000a; font-weight: 700; padding: 10px">Attention!</div>
                    <div class="panel-body">
                            Please Verify your Email first before you can use the Full Feature of this website.<br>
                            No Email Received? <a href="\resendCode" style="font-weight: bold;">Resend Verification</a>.<br>
                            Wrong Email? <a href="\edit-user" style="font-weight: bold;">Click here</a> to Update your email.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection