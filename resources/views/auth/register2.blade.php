@extends('layouts.reg')
@section('content')
    <div class="container">
            <div class="col-md-8 col-md-offset-2" >
                <div class="card" style="margin-top: 40px">
                    <div class="panelcolor">Membership Account Registration</div>
                    <div class="panel-body">

                        {{Form::open(['url'=> route('register') , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form'])}}
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('student_number') ? ' has-error' : '' }}">
                                {{Form::label('student_no', 'Student Number', ['class' => 'col-md-4 control-label'])}}
                                <div class="col-md-6">
                                    <input id="student_no" type="text" class="form-control" name="student_number" required >

                                    @if ($errors->has('student_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('student_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lname') ? ' has-error': '' }}">
                                {{Form::label('lname', 'Surname', ['class' => 'col-md-4 control-label'])}}
                                <div class="col-md-6">
                                    {{Form::text('lname', '', ['class' => 'form-control', 'id' => 'lname'])}}

                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fname') ? ' has-error': '' }}">
                                {{Form::label('fname', 'Firstname', ['class' => 'col-md-4 control-label'])}}

                                <div class="col-md-6">
                                    {{Form::text('fname', '', ['class' => 'form-control'])}}

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('mname') ? ' has-error': '' }}">
                                {{Form::label('mname', 'Middlename', ['class' => 'col-md-4 control-label'])}}

                                <div class="col-md-6">
                                    {{Form::text('mname', '', ['class' => 'form-control'])}}

                                    @if ($errors->has('mname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('civilStatus') ? 'has-error' : ''}}">
                                {{ Form::label('civilStatus', 'Civil Status',['class'=>'col-md-4 control-label']) }}
                                <div class="col-md-6">

                                    <select name="civilStatus" class="form-control">
                                        @foreach($cStatus as $civil)
                                            <option  value="{{$civil->civil_status_id}}">{{$civil->civil_status}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('civilStatus'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('civilStatus') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group {{$errors->has('college') ? 'has-error' : ''}}">
                                {{ Form::label('college', 'College',['class'=>'col-md-4 control-label']) }}
                                <div class="col-md-6">

                                    <select id="collegeList" class="form-control" disabled>
                                        <option value="0">Please select</option>
                                        @foreach($colleges as $college)
                                            <option  value="{{$college->college_code}}">{{$college->college}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('college'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('college') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('degree') ? 'has-error' : ''}}">
                                {{ Form::label('degree', 'Degree',['class'=>'col-md-4 control-label']) }}
                                <div class="col-md-6">

                                    <select id="degreeList" name="degree" class="form-control" disabled>

                                        <option value="0">Please Select</option>
                                        @foreach($degrees as $degree)
                                            <option  value="{{$degree->id}}">{{$degree->degree}}</option>
                                        @endforeach

                                    </select>

                                    @if ($errors->has('degree'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('degree') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group {{$errors->has('year_graduated') ? 'has-error' : ''}}">
                                {{ Form::label('year', 'SY Graduated',['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    <input id="year_grad" class="form-control" disabled>

                                    @if ($errors->has('year_graduated'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('year_graduated') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('sem_graduated') ? 'has-error' : ''}}">
                                {{ Form::label('year', 'Sem Graduated',['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    <select id="sem_grad" required="required" class="form-control" disabled>
                                        <option value="1">First Sem</option>
                                        <option value="2">Second Sem</option>
                                        <option value="3">Summer</option>

                                    </select>

                                    @if ($errors->has('sem_graduated'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sem_graduated') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('or_code') ? ' has-error' : '' }}">
                                {{Form::label('or_code', 'O.R. Number', ['class' => 'col-md-4 control-label'])}}

                                <div class="col-md-6">
                                    {{Form::text('or_code', '', ['class' => 'form-control'])}}

                                    @if ($errors->has('or_code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('or_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('datePaid') ? ' has-error' : '' }}">
                                {{Form::label('datePaid', 'Date Paid', ['class' => 'col-md-4 control-label'])}}

                                <div class="col-md-6">
                                    {{Form::text('datePaid', '', ['class' => 'datepicker form-control'])}}
                                    <script type="text/javascript">
                                        $('.datepicker').datepicker({
                                            format: 'M d, yyyy'
                                        });
                                    </script>

                                    @if ($errors->has('datePaid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('datePaid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6" hidden>
                                <input name="dob" id="dob" class="form-control" />
                                <input name="pob" id="pob" class="form-control" />
                                <input name="province" id="provList1" class="form-control" />
                                <input name="city" id="cityList1" class="form-control" />
                                <input name="brgy" id="brgyList1" class="form-control" />
                                <input name="gender" id="gender" class="form-control" />
                                <input name="contact" id="contact" class="form-control" />

                                <input name="edu1" class="form-control" id="edu1"/>
                                <input name="edu2" class="form-control" id="edu2"/>
                                <input name="l1" class="form-control" id="l1"/>
                                <input name="l2" class="form-control" id="l2"/>
                                <input name="ey1" class="form-control" id="ey1"/>
                                <input name="ey2" class="form-control" id="ey2"/>
                            </div>
                        </div>
                        <div class="form-group" align="center">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn-main">
                                    Register
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    <div class="container">
        <hr class="featurette-divider">

        <footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2017 Mariano Marcos State University. All Rights Reserved.</p>
        </footer>
    </div>
    </div>
@endsection
