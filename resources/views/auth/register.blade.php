@extends('layouts.reg')
@section('carousel')
    <div class="carousel-login" style="margin-top: 100px"></div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="page-header" style="color: white">
                <h2>Attention!</h2><br>
                <p>
                    Before you register an Alumni Account, make sure to complete the <strong>Application for Graduation</strong> first.<br>
                    Click <a href="http://app-grad.mmsu.edu.ph/form" class="btn-sec" target="_blank">Here</a> to Apply.
                </p>
                <!--<p>
                    For <strong>1971-2016</strong> Graduates<br>
                    Click <a href="/register-2" class="btn-sec" target="_blank">Here</a> to Register.
                </p>-->
            </div>
        </div>
        <div class="col-md-8" >
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

                    <!--<div class="form-group">
                                {{ Form::label('major', 'Major',['class'=>'col-md-4 control-label']) }}
                            <div class="col-md-6">

                                <select id="majorList111" name="major" class="form-control">
                                    <option value="0">Please Select</option>

                                </select>
                            </div>
                        </div>-->

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
                            <input name="major" id="majorList" class="form-control" />
                            <input name="college" class="form-control" id="collegeList2"/>
                            <input name="degree" class="form-control" id="degreeList2"/>
                            <input name="year_graduated" class="form-control" id="year_grad2"/>
                            <input name="sem_graduated" class="form-control" id="sem_grad2"/>

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
</div>
<div class="container">
    <hr class="featurette-divider">

    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017 Mariano Marcos State University. All Rights Reserved.</p>
    </footer>
</div>

<script type="text/javascript">
    $(document).ready(function()
    { var ac_config = {
        source: "/stud",
        select: function(event, ui){
            $("#lname").val(ui.item.lname);
            $("#fname").val(ui.item.fname);
            $("#mname").val(ui.item.mname);
            $('#provList1').val(ui.item.prov);
            $('#cityList1').val(ui.item.city);
            $('#brgyList1').val(ui.item.house_number);
            $('#gender').val(ui.item.gender);
            $('#collegeList').val(ui.item.college);
            $('#degreeList').val(ui.item.degree);
            $('#collegeList2').val(ui.item.college);
            $('#degreeList2').val(ui.item.degree);
            $('#majorList').val(ui.item.major);
            $('#year_grad').val(ui.item.ay);
            $('#year_grad2').val(ui.item.ay);
            $('#sem_grad').val(ui.item.sem);
            $('#sem_grad2').val(ui.item.sem);
            $('#dob').val(ui.item.dob);
            $('#pob').val(ui.item.pob);
            $('#contact').val(ui.item.contact_number);
            $('#edu1').val(ui.item.edu1);
            $('#edu2').val(ui.item.edu2);
            $('#l1').val(ui.item.l1);
            $('#l2').val(ui.item.l2);
            $('#ey1').val(ui.item.ey1);
            $('#ey2').val(ui.item.ey2);

        },
        minLength: 1,
        autoFocus: true
    };
        $("#student_no").autocomplete(ac_config); });

</script>
@endsection
