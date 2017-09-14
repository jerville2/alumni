@extends('layouts.app')
@section('carousel')
    <div class="carousel"></div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="panelcolor">
                        Update Email
                    </div>
                    <div class="panel-body">

                        {{Form::open(['url' => '/update-user', 'method' => 'post', 'class' => 'form-horizontal', 'files' => 'true', 'role' => 'form'])}}
                        {{Form::token()}}

                        <div class="form-group"></div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            {{Form::label('email', 'Email', ['class' => 'col-md-4 control-label'])}}
                            <div class="col-md-6">
                                {{Form::text('email', Auth::user()->email, ['type' => 'email', 'class' => 'col-md-4 form-control'])}}
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div align="center">
                                <button type="submit" class="btn-main fcolor">
                                    <i class="glyphicon glyphicon-ok"></i> Save
                                </button>
                            </div>
                        </div>

                        {{Form::close()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection