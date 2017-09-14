@extends('layouts.reg')
@section('hs')
    <link href="{{ asset('css/upload.css') }}" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('#myTab a[href="#{{ old('tab') }}"]').tab('show')
        });
    </script>
    @endsection
@section('carousel')
    <div class="carousel-profile"  style="background: radial-gradient(rgba(218,165,32,0.51), rgba(255,215,0,0.5), rgba(0,100,50,0.51) 60%);"></div>
    @endsection
@section('myprofile')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="panel-body">
                        <div align="center">
                            <div class="conten">
                                @if($user->picture == null)
                                    <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage/uploads/imgs/default.png') }}">
                                @else
                                    <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage'.$user->picture->location) }}">
                                @endif
                                {{ Form::open(['url'=> 'upimage' , 'method' => 'post', 'files'=>'true','role'=>'form', 'id' => 'upload']) }}
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                        <div class="fileUpload btn btn-default upload_button">
                                            <span><i class="glyphicon glyphicon-camera"></i> </span>
                                            <input type="file" class="upload" name="image" accept="image/png, image/jpeg, image/jpg" onchange="this.form.submit()" id="saveButton"/>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="help-block" style="background: rgba(255,0,0,0.16)">
                                                <strong><i class="glyphicon glyphicon-alert"></i> {{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="modal fade" id="progressDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 250px">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <strong>Uploading Images...</strong>

                                                    <div class="progress progress-striped active">
                                                        <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                            <span class="sr-only"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    {{ Form::close() }}
                            </div>
                        </div>
                        <ul class="nav nav-tab" role="tablist">
                            @if($user->alumni->firstname <> 'MMSU')
                            <li style="margin-bottom: -1px"><a class="buttonmini" href="account">My Account</a></li>
                            <li style="margin-bottom: -1px"><a class="buttonmini" href="#" data-toggle="modal" data-target="#edit_profile">Edit my Profile</a></li>
                            <li style="margin-bottom: -1px"><a class="buttonmini" href="#" data-toggle="modal" data-target="#emp">Add Employment Details</a></li>
                            @endif
                            <li style="margin-bottom: -1px">
                                <a class="buttonmini" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="panel-body">
                        <div align="center">
                            <strong>Post Something</strong><br>
                            Share your story, interests, and past employment.
                            <hr>
                            <a class="btn-main" href="#" data-toggle="modal" data-target="#post">post</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                @if($user->alumni->firstname == 'MMSU')
                    <div class="card">
                        <div class="wrapper">
                            <ul class="nav nav-tabs list" role="tablist" id="myTab">
                                <li role="presentation" class="active"><a href="#myPost" aria-controls="settings" role="tab" data-toggle="tab">My Post</a></li>
                                <li role="presentation"><a href="#account" aria-controls="settings" role="tab" data-toggle="tab">Account Info</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="myPost" class="tab-pane fade in active">
                                <div align="center">
                                    <div align="center">
                                        <a href="/my_profile/myPost" class="button button-1a">Show All</a>
                                    </div>
                                </div>
                                <div class="panel-body col-md-offset-1">
                                    @if($user->posts->count() == 0)
                                        No Post Found
                                    @else
                                        @foreach($user->posts->sortByDesc('id')->take(3) as $post)
                                            <div class="card2">
                                                <div class="dropdown">
                                                <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                                                    </span>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li role="presentation"><a id="delete{{ $post->id }}" href="#">delete</a></li>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#delete{{$post->id }}').click(function(){
                                                                    swal({
                                                                            title: "Delete",
                                                                            text: "Are you Sure You want to delete this Post?",
                                                                            type: "warning",
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: "Green",
                                                                            confirmButtonText: "Yes"
                                                                        },
                                                                        function(){
                                                                            document.forms["myform{{$post->id}}"].submit();
                                                                        });
                                                                })
                                                            });
                                                        </script>
                                                        <form id="myform{{$post->id}}" action="deletePost/{{ $post->id }}" method="POST">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </ul>
                                                </div>

                                                <div class="panel-body">
                                                    <blockquote>
                                                        <p style="font-size: 14px; font-style: italic">{!! \Illuminate\Support\Str::words(strip_tags($post->post), 15) !!}</p>
                                                    </blockquote>
                                                    <p>{{ date('M d, Y - h:i:s', strtotime($post->date)) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div id="account" class="tab-pane">
                                <div class="page-header col-md-offset-1"><h3>Account Information</h3></div>
                                <div class="panel-body col-md-offset-1">
                                    <dl class="dl-horizontal">
                                        <dt>Email</dt>
                                        <dd>{{ $user->email }}</dd>
                                        <dt>Password</dt>
                                        <dd><a href="change_pass">Change Password</a></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="card">
                    <div class="scroller scroller-left"><i class="glyphicon glyphicon-chevron-left"></i></div>
                    <div class="scroller scroller-right"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    <div class="wrapper">
                        <ul class="nav nav-tabs list" role="tablist" id="myTab">
                            <li role="presentation" class="active"><a href="#overview" aria-controls="home" role="tab" data-toggle="tab">Overview</a></li>
                            <li role="presentation"><a href="#personal" aria-controls="profile" role="tab" data-toggle="tab">Personal Info</a></li>
                            <li role="presentation"><a href="#academic" aria-controls="messages" role="tab" data-toggle="tab">Academic Info</a></li>
                            <li role="presentation"><a href="#employment" aria-controls="settings" role="tab" data-toggle="tab">Employment Info</a></li>
                            <li role="presentation"><a href="#account" aria-controls="settings" role="tab" data-toggle="tab">Account Info</a></li>
                            <li role="presentation"><a href="#myPost" aria-controls="settings" role="tab" data-toggle="tab">My Post</a></li>
                            <li role="presentation"><a href="#eligibility" aria-controls="settings" role="tab" data-toggle="tab">Eligibility</a></li>
                            <li role="presentation"><a href="#org" aria-controls="settings" role="tab" data-toggle="tab">Organizations</a></li>
                            <li role="presentation"><a href="#pub" aria-controls="settings" role="tab" data-toggle="tab">Publications</a></li>
                            <li role="presentation"><a href="#award" aria-controls="settings" role="tab" data-toggle="tab">Awards</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade in active">
                            <div class="page-header col-md-offset-1"><h3>Personal Information</h3></div>
                            <div class="panel-body col-md-offset-1">
                                <dl class="dl-horizontal">
                                    <dt>Nme</dt>
                                    <dd>{{ $user->alumni->firstname.' '.$user->alumni->middlename.' '.$user->alumni->surname }}</dd>
                                    <dt>Address 1</dt>
                                    <dd>@if($user->profile->brgyCode == 0)
                                            None
                                        @else
                                            {{ $user->profile->brgy->brgyDesc.', '.$user->profile->city->citymunDesc.', '.$user->profile->province->provDesc }}
                                        @endif
                                    </dd>
                                    <dt>Address 2</dt>
                                    <dd>
                                        @if( $user->addresses == null)
                                            None
                                        @else
                                            {{ $user->addresses->address }}
                                        @endif
                                    </dd>
                                    <dt>Gender</dt>
                                    <dd>{{ $user->profile->sex }}</dd>
                                    <dt>Civil Status</dt>
                                    <dd>{{ $user->profile->civilStatus->civil_status }}</dd>
                                    <dt>Contact Number</dt>
                                    <dd>{{ $user->profile->mobile }}</dd>

                                </dl>
                            </div>
                            <div class="page-header col-md-offset-1"><h3>Academic Information</h3></div>
                            <div class="panel-body col-md-offset-1">
                                <dl class="dl-horizontal">
                                    <dt>College</dt>
                                    <dd>{{ $user->alumni->college->college }}</dd>
                                    <dt>Degree</dt>
                                    <dd>{{ $user->alumni->degree->degree }}</dd>
                                    <dt>Major</dt>
                                    <dd>{{ $user->alumni->major->major }}</dd>
                                    <dt>SY Graduated</dt>
                                    <dd>{{ $user->alumni->year_graduated }}</dd>
                                    <dt>Sem Graduated</dt>
                                    <dd>
                                        @if($user->alumni->sem_graduated == 1)
                                            First Semester
                                        @elseif($user->alumni->sem_graduated == 2)
                                            Second Semester
                                        @else
                                            Summer
                                        @endif
                                    </dd>

                                </dl>
                            </div>

                        </div>

                        <div id="personal" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Personal Information</h3></div>
                            <div class="panel-body col-md-offset-1">
                                <dl class="dl-horizontal">
                                    <dt>Name</dt>
                                    <dd>{{ $user->alumni->firstname.' '.$user->alumni->middlename.' '.$user->alumni->surname }}</dd>
                                    <dt>Address 1</dt>
                                    <dd>@if($user->profile->brgyCode == 0) None @else
                                            {{ $user->profile->brgy->brgyDesc.', '.$user->profile->city->citymunDesc.', '.$user->profile->province->provDesc }}
                                        @endif
                                    </dd>
                                    <dt>Address 2</dt>
                                    <dd>@if( $user->addresses == null) None @else
                                            {{ $user->addresses->address }}
                                        @endif
                                    </dd>
                                    <dt>Gender</dt>
                                    <dd>{{ $user->profile->sex }}</dd>
                                    <dt>Civil Status</dt>
                                    <dd>{{ $user->profile->civilStatus->civil_status }}</dd>
                                    <dt>Contact Number</dt>
                                    <dd>{{ $user->profile->mobile }}</dd>
                                    <dt>Birthday</dt>
                                    <dd>{{ strtoupper( date('F d, Y', strtotime($user->profile->birthdate))) }}</dd>
                                    <dt>Birth Place</dt>
                                    <dd>{{ $user->profile->birthplace }}</dd>
                                    <dt>Citizenship</dt>
                                    <dd>@if($user->profile->citizenship_id == null) N/A @else
                                            {{ $user->profile->citizen->citizenship }}
                                        @endif
                                    </dd>
                                    <dt>Religion</dt>
                                    <dd>
                                        @if($user->profile->religion_id == null)
                                            N/A
                                        @else
                                            {{ $user->profile->religion->religion }}
                                        @endif
                                    </dd>

                                </dl>
                                <hr>
                                <div align="center">
                                    <button href="#" data-toggle="modal" data-target="#edit_profile" class="button button-1a">Update Personal Info</button>
                                </div>
                            </div>
                        </div>

                        <div id="academic" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Academic Information</h3></div>
                            <div class="panel-body">
                                <dl class="dl-horizontal col-md-offset-1">
                                    <dt>College</dt>
                                    <dd>{{ $user->alumni->college->college }}</dd>
                                    <dt>Degree</dt>
                                    <dd>{{ $user->alumni->degree->degree }}</dd>
                                    <dt>Major</dt>
                                    <dd>{{ $user->alumni->major->major }}</dd>
                                    <dt>SY Graduated</dt>
                                    <dd>{{ $user->alumni->year_graduated }}</dd>
                                    <dt>Sem Graduated</dt>
                                    <dd>
                                        @if($user->alumni->sem_graduated == 1)
                                            First Semester
                                        @elseif($user->alumni->sem_graduated == 2)
                                            Second Semester
                                        @else
                                            Summer
                                        @endif
                                    </dd>

                                </dl>
                            </div>

                            <div class="page-header col-md-offset-1"><h3>Pre-University Information</h3></div>
                            <div class="panel-body">
                                <dl class="dl-horizontal col-md-offset-1">
                                    @foreach($user->educations as $education)
                                        <dt>Level</dt>
                                        @if($education->level == 1)
                                            <dd>Elementary</dd>
                                        @elseif($education->level == 2)
                                            <dd>Secondary</dd>
                                        @elseif($education->level == 3)
                                            <dd>Vocational/Trade Course</dd>
                                        @elseif($education->level == 4)
                                            <dd>College</dd>
                                        @elseif($education->level == 5)
                                            <dd>Graduate Studies</dd>
                                        @endif
                                    <dt>School</dt>
                                    <dd>{{ $education->school }}</dd>
                                    <dt>Year Graduated</dt>
                                    <dd>{{ $education->date_graduated }}</dd>
                                        <hr>
                                        @endforeach
                                </dl>
                            </div>
                        </div>

                        <div id="employment" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Employment Information</h3></div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->employment->count() == 0)
                                    No record Found
                                @else
                                @foreach($user->employment->sortByDesc('date') as $emp)
                                    <dl class="dl-horizontal">
                                        <dt>Company Name</dt>
                                        <dd>{{ $emp->employer }}</dd>
                                        <dt>Position</dt>
                                        <dd>{{ $emp->position }}</dd>
                                        <dt>Employer Address</dt>
                                        <dd>{{ $emp->address }}</dd>
                                        <dt>Employer Email</dt>
                                        <dd>{{ $emp->email }}</dd>
                                        <dt>Employer Contact</dt>
                                        <dd>{{ $emp->contact }}</dd>
                                    </dl>
                                            <div align="center">
                                                <button id="delete{{$emp->emp_code }}" class="btn-del">delete record</button>
                                                <script>
                                                    $(document).ready(function(){
                                                        $('#delete{{$emp->emp_code }}').click(function(){
                                                            swal({
                                                                    title: "Delete",
                                                                    text: "Are you Sure You want to delete this Record?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "Green",
                                                                    confirmButtonText: "Yes"
                                                                },
                                                                function(){
                                                                    document.forms["myform{{$emp->emp_code}}"].submit();
                                                                });
                                                        })
                                                    });
                                                </script>
                                            </div>
                                        <form id="myform{{$emp->emp_code}}" action="deleteEmp/{{ $emp->emp_code }}" method="POST">
                                            {{ csrf_field() }}
                                        </form>
                                <hr>
                                @endforeach
                                @endif
                                    <hr>
                                    <div align="center">
                                        <button data-toggle="modal" data-target="#emp" class="button button-1a">Add Employment</button>
                                    </div>
                            </div>
                        </div>

                        <div id="account" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Account Information</h3></div>
                            <div class="panel-body col-md-offset-1">
                                <dl class="dl-horizontal">
                                    <dt>Email</dt>
                                    <dd>{{ $user->email }}</dd>
                                    <dt>Password</dt>
                                    <dd><a href="change_pass">Change Password</a></dd>
                                </dl>
                            </div>
                        </div>

                        <div id="myPost" class="tab-pane">
                            <div align="center">
                                <div align="center">
                                    <a href="/my_profile/myPost" class="button button-1a">Show All</a>
                                </div>
                            </div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->posts->count() == 0)
                                    No Post Found
                                    @else
                                    @foreach($user->posts->sortByDesc('id')->take(3) as $post)
                                        <div class="card2">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                                                    </span>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li role="presentation"><a id="delete{{ $post->id }}" href="#">delete</a></li>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#delete{{$post->id }}').click(function(){
                                                                swal({
                                                                        title: "Delete",
                                                                        text: "Are you Sure You want to delete this Post?",
                                                                        type: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "Green",
                                                                        confirmButtonText: "Yes"
                                                                    },
                                                                    function(){
                                                                        document.forms["myform{{$post->id}}"].submit();
                                                                    });
                                                            })
                                                        });
                                                    </script>
                                            <form id="myform{{$post->id}}" action="deletePost/{{ $post->id }}" method="POST">
                                                {{ csrf_field() }}
                                            </form>
                                                </ul>
                                            </div>

                                            <div class="panel-body">
                                                <blockquote>
                                                    <p style="font-size: 14px; font-style: italic">{!! \Illuminate\Support\Str::words(strip_tags($post->post), 15) !!}</p>
                                                </blockquote>
                                                <p>{{ date('M d, Y - h:i:s', strtotime($post->date)) }}</p>
                                            </div>
                                        </div>

                                        @endforeach
                                @endif
                            </div>
                        </div>

                        <div id="eligibility" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Eligibility</h3></div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->eligibility->count() == 0)
                                    No Records Found
                                    @else
                                    <dl class="dl-horizontal">
                                        @foreach($user->eligibility as $eli)
                                        <dt>Eligibility</dt>
                                        <dd>{{ $eli->eligibility }}</dd>
                                        <dt>Exam Place</dt>
                                        <dd>{{ $eli->examplace }}</dd>
                                        <dt>Exam Date</dt>
                                        <dd>{{ date('M d, Y', strtotime($eli->examdate)) }}</dd>
                                        <dt>Rating</dt>
                                        <dd>{{ $eli->rating }}%</dd>
                                            <hr>
                                            @endforeach
                                    </dl>
                                    @endif
                                <hr>
                                    <div align="center">
                                        <button data-toggle="modal" data-target="#elig" class="button button-1a">Add Details</button>
                                    </div>
                            </div>
                        </div>

                        <div id="org" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Organizations</h3></div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->organizations->count() == 0)
                                    No Records Found
                                @else
                                    <dl class="dl-horizontal">
                                        @foreach($user->organizations as $org)
                                            <dt>Organization</dt>
                                            <dd>{{ $org->organization }}</dd>
                                            <dt>Position</dt>
                                            <dd>{{ $org->highpos }}</dd>
                                            <dt>'Period</dt>
                                            <dd>{{ $org->period }}</dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                @endif
                                    <hr>
                                    <div align="center">
                                        <button data-toggle="modal" data-target="#orgs" class="button button-1a">Add Details</button>
                                    </div>
                            </div>
                        </div>

                        <div id="pub" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Publications</h3></div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->publications->count() == 0)
                                    No Records Found
                                @else
                                    <dl class="dl-horizontal">
                                        @foreach($user->publications as $pub)
                                            <dt>Title</dt>
                                            <dd>{{ $pub->publication }}</dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                @endif
                                    <hr>
                                    <div align="center">
                                        <button data-toggle="modal" data-target="#pubs" class="button button-1a">Add Details</button>
                                    </div>
                            </div>
                        </div>

                        <div id="award" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Awards</h3></div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->awards->count() == 0)
                                    No Records Found
                                @else
                                    <dl class="dl-horizontal">
                                        @foreach($user->awards as $award)
                                            <dt>Award</dt>
                                            <dd>{{ $award->award }}</dd>
                                            <dt></dt>
                                            <dd>{{ date('M d, Y', strtotime($award->dategiven)) }}</dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                @endif
                                    <hr>
                                    <div align="center">
                                        <button data-toggle="modal" data-target="#awards" class="button button-1a">Add Details</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-2">
                <div class="card">
                    <div class="panel-body">
                        <h4 align="center">Alumni Directory</h4>
                        <hr>
                        <p align="center">
                            Keep your profile up-to-date. Share your story, interests, and past employment.
                        </p>
                        <ul class="nav nav-tab" role="tablist">
                            <li style="margin-bottom: 10px" align="center"><a class="buttonmini" href="/alumni/home">Browse Directory</a></li>
                            <li align="center"><a class="buttonmini" href="/alumni">Directory List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($user->alumni->firstname != 'MMSU')
    <!-- Modal -->
    <div class="modal fade" id="emp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel">Add/Edit Employment Details</h4>
                </div>
                <div class="modal-body">
                    {{Form::open(['url'=> 'update_emp' , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form'])}}
                    {{ Form::token() }}

                    <div class="form-group{{ $errors->has('employer') ? ' has-error' : '' }}">
                        {{Form::label('name', 'Employer*', ['class' => 'col-md-4 control-label'])}}

                        <div class="col-md-6">
                            {{Form::text('employer', '' , ['class' => 'form-control', 'required'])}}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                        {{Form::label('name', 'Position*', ['class' => 'col-md-4 control-label'])}}

                        <div class="col-md-6">
                            {{Form::text('position', '' , ['class' => 'form-control', 'required'])}}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('employer_addrs') ? ' has-error' : '' }}">
                        {{Form::label('name', 'Employer Address*', ['class' => 'col-md-4 control-label'])}}

                        <div class="col-md-6">
                            {{Form::text('employer_addrs', '', ['class' => 'form-control', 'required'])}}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('employer_email') ? ' has-error' : '' }}">
                        {{Form::label('name', 'Employer Email', ['class' => 'col-md-4 control-label'])}}

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="employer_email">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('employer_contact') ? ' has-error' : '' }}">
                        {{Form::label('name', 'Employer Contact', ['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('employer_contact', '', ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div align="center">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>Save
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel2">Update Personal Information</h4>
                </div>
                <div class="modal-body">
                    {{Form::open(['url'=> 'update_info' , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form'])}}
                    {{ Form::token() }}

                    <div class="form-group {{$errors->has('province') ? 'has-error' : ''}}">
                        {{ Form::label('province', 'Province',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">

                            <select id="provList" name="province" class="form-control">
                                @if($user->profile->provCode == 0)
                                    <option value="0">Please Select</option>
                                @else
                                    <option value="{{$user->profile->provCode}}">{{ $user->profile->province->provDesc }}</option>
                                @endif
                                @foreach($provinces as $province)
                                    <option  value="{{$province->provCode}}">{{$province->provDesc}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('province'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group {{$errors->has('city') ? 'has-error' : ''}}">
                        {{ Form::label('city', 'Municipality/City',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">

                            <select id="cityList" name="city" class="form-control">
                                @if($user->profile->provCode == 0)
                                    <option value="0">Please Select</option>
                                @else
                                    <option value="{{ $user->profile->citymunCode }}">{{ $user->profile->city->citymunDesc }}</option>
                                @endif
                            </select>

                            @if ($errors->has('city'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group {{$errors->has('brgy') ? 'has-error' : ''}}">
                        {{ Form::label('brgy', 'Barangay',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">

                            <select id="brgyList" name="brgy" class="form-control">
                                @if($user->profile->provCode == 0)
                                    <option value="0">Please Select</option>
                                @else
                                    <option value="{{ $user->profile->brgyCode }}">{{ $user->profile->brgy->brgyDesc }}</option>
                                @endif
                            </select>

                            @if ($errors->has('brgy'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('brgy') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('addrs', 'Address 2', ['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            @if( $user->addresses == null)
                            <?php $address2 = ''; ?>
                            @else
                                <?php $address2 = $user->addresses->address ?>
                            @endif
                                {{Form::textarea('addrs', $address2 , ['class' => 'form-control', 'id' => 'contact'])}}
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('civilStatus') ? 'has-error' : ''}}">
                        {{ Form::label('civilStatus', 'Civil Status',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            <select name="civilStatus" class="form-control">
                                <option  value="{{$user->profile->civil_status_id}}">{{$user->profile->civilStatus->civil_status}}</option>
                                @foreach($cStatus as $civil)
                                    <option  value="{{$civil->civil_status_id}}">{{$civil->civil_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('contact') ? ' has-error': '' }}">
                        {{Form::label('contact', 'Contact Number', ['class' => 'col-md-4 control-label'])}}

                        <div class="col-md-6">
                            {{Form::text('contact', $user->profile->mobile, ['class' => 'form-control', 'id' => 'contact'])}}

                            @if ($errors->has('contact'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('gContact', 'Parent/Guardian Number', ['class' => 'col-md-4 control-label'])}}

                        <div class="col-md-6">
                            {{Form::text('gContact', $user->profile->guardian_telno, ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('citizen') ? 'has-error' : ''}}">
                        {{ Form::label('citizen', 'Citizenship',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">

                            <select name="citizen" class="form-control">
                                @if($user->profile->citizenship_id == null )
                                    <option value="0">Please Select</option>
                                @else
                                    <option value="{{ $user->profile->citizenship_id }}">{{ $user->profile->citizen->citizenship }}</option>
                                @endif
                                @foreach($citizens as $citizen)
                                    <option  value="{{$citizen->citizenship_id}}">{{$citizen->citizenship}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('citizen'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('citizen') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group {{$errors->has('religion') ? 'has-error' : ''}}">
                        {{ Form::label('religion', 'Religion',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">

                            <select name="religion" class="form-control">
                                @if($user->profile->religion_id == null)
                                    <option value="0">Please Select</option>
                                @else
                                    <option value="{{ $user->profile->religion_id }}">{{ $user->profile->religion->religion }}</option>
                                @endif
                                @foreach($religions as $religion)
                                    <option  value="{{$religion->religion_id}}">{{$religion->religion}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('citizen'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('citizen') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <div align="center">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>Save
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>

                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="elig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel3">Eligibility</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'eligibility' , 'method' => 'post', 'class'=>'form-horizontal','role'=>'form', 'id' => 'pass_change']) }}
                    {{ Form::token() }}
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Eligibility</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="eligibility" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Exam Place</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="examplace">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Exam Date</label>
                        <div class="col-md-6">
                            <input type="text" class="datepicker form-control" name="examdate" id="edate">
                            <script type="text/javascript">
                                $('.datepicker').datepicker({
                                    format: 'M d, yyyy'
                                });
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rate" class="col-md-4 control-label">Rating</label>
                        <div class="col-md-6">
                            <input id="rate" type="text" class="form-control" name="rating" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div align="center">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>Save
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orgs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel3">Organizations</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'organization' , 'method' => 'post', 'class'=>'form-horizontal','role'=>'form']) }}
                    {{ Form::token() }}
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Organization</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="organization" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pos" class="col-md-4 control-label">Position</label>
                        <div class="col-md-6">
                            <input id="pos" type="text" class="form-control" name="position">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="period" class="col-md-4 control-label">Period</label>
                        <div class="col-md-6">
                            <input id="period" type="text" class="form-control" name="period" placeholder="2016-2022" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>Save
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pubs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel3">Publications</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'publication' , 'method' => 'post', 'class'=>'form-horizontal','role'=>'form']) }}
                    {{ Form::token() }}
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Title</label>
                        <div class="col-md-6">
                            {{Form::textarea('publication', '', ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>Save
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="awards" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel3">Publications</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'award' , 'method' => 'post', 'class'=>'form-horizontal','role'=>'form']) }}
                    {{ Form::token() }}
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Award</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="award" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Date Awarded</label>
                        <div class="col-md-6">
                            <input type="text" class="datepicker form-control" name="awarddate" id="adate" required>
                            <script type="text/javascript">
                                $('.datepicker').datepicker({
                                    format: 'M d, yyyy'
                                });
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>Save
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade" id="post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel7">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel7">Share your Story</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'post-share' , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','id'=>'qwe']) }}
                    {{ Form::token() }}
                    <div class="form-group" style="margin: 5px">
                        {{ Form::label('title', 'Title(Optional)', ['class' => 'control-label']) }}
                        {{ Form::text('title', '', [ 'class' => 'form-control']) }}

                    </div>
                    <div hidden>
                        {{ Form::text('url', 'my_profile', [ 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group" style="margin: 5px">
                        {{ Form::label('title', 'Post', ['class' => 'control-label']) }}
                        <textarea name="contents" id="ckeditor" class="ckeditor" cols="30" rows="25" required></textarea>
                    </div>

                    <div class="form-group" style="margin: 5px">
                        <input type="checkbox" value="1" name="pub" checked>
                        {{ Form::label('title', 'Share on alumni Directory', ['class' => 'control-label']) }}
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn-main">
                                <i class="glyphicon glyphicon-ok"></i>post
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <script src="//cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
                    <script type="text/javascript">
                        CKEDITOR.replace( 'ckeditor');
                        $("form").submit( function(e) {
                            var messageLength = CKEDITOR.instances['ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
                            if( !messageLength ) {
                                swal({
                                    title: "Attention!",
                                    text: "Post field is required",
                                    type: "warning",
                                });
                                e.preventDefault();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/tab.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#saveButton").click(function() {
                $('#progressDialog').modal('show');

                var updateForm = document.querySelector('Form');
                var request = new XMLHttpRequest();

                request.upload.addEventListener('progress', function(e){
                    var percent = Math.round((e.loaded / e.total) * 100);
                    $('.progress-bar').width(percent+'%');
                    $('.sr-only').html(percent+'%');
                }, false);

                request.addEventListener('load', function(e){
                    var jsonResponse = JSON.parse(e.target.responseText);
                    if(jsonResponse.errors) {
                        console.log(jsonResponse.errors);
                    }
                    else {
                        $('#progressDialog').modal('hide');
                    }
                }, false);

                updateForm.addEventListener('submit', function(e){
                    e.preventDefault();
                    var formData = new FormData(updateForm);
                    request.open('post',updateForm['action']);
                    request.send(formData);
                }, false);
            })
        });
    </script>
    @endsection