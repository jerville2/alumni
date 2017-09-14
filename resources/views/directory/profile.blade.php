@extends('layouts.reg')
@section('carousel')
    <div class="carousel-profile"  style="background: radial-gradient(rgba(218,165,32,0.51), rgba(255,215,0,0.5), rgba(0,100,50,0.51) 60%);"></div>
@endsection
@section('myprofile')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="panel-body">
                        <div align="center">
                            <div class="conten">
                                @if($user->picture == null)
                                    <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage/uploads/imgs/default.png') }}">
                                @else
                                    <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage'.$user->picture->location) }}">
                                @endif
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tab" role="tablist">
                        <li style="margin-bottom: -1px"><a class="buttonmini" href="/alumni">directory list</a></li>
                        <li style="margin-bottom: -1px"><a class="buttonmini" href="/alumni/home">browse directory</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">

                    <div class="scroller scroller-left"><i class="glyphicon glyphicon-chevron-left"></i></div>
                    <div class="scroller scroller-right"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    <div class="wrapper">
                    <ul class="nav nav-tabs list" role="tablist" id="myTab">
                        <li role="presentation" class="active"><a href="#overview" aria-controls="home" role="tab" data-toggle="tab">Overview</a></li>
                        <li role="presentation"><a href="#personal" aria-controls="profile" role="tab" data-toggle="tab">Personal Info</a></li>
                        <li role="presentation"><a href="#academic" aria-controls="messages" role="tab" data-toggle="tab">Academic Info</a></li>
                        <li role="presentation"><a href="#employment" aria-controls="settings" role="tab" data-toggle="tab">Employment Info</a></li>
                        <li role="presentation"><a href="#myPost" aria-controls="messages" role="tab" data-toggle="tab">Post</a></li>
                        <li role="presentation"><a href="#eligibility" aria-controls="settings" role="tab" data-toggle="tab">Eligibility</a></li>
                        <li role="presentation"><a href="#org" aria-controls="settings" role="tab" data-toggle="tab">Organizations</a></li>
                        <li role="presentation"><a href="#pub" aria-controls="settings" role="tab" data-toggle="tab">Publications</a></li>
                        <li role="presentation"><a href="#award" aria-controls="settings" role="tab" data-toggle="tab">Awards</a></li>
                    </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-content">
                            <div id="overview" class="tab-pane fade in active">
                                <div class="page-header" style="margin-top: -40px"><h3>Personal Information</h3></div>
                                <div class="panel-body">
                                    <dl class="dl-horizontal">
                                        <dt>Nme</dt>
                                        <dd>{{ $user->alumni->firstname.' '.$user->alumni->middlename.' '.$user->alumni->surname }}</dd>
                                        @if($user->profile != null)
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
                                        <dd>
                                            @if($user->profile->civilStatus != '0')
                                                {{ $user->profile->civilStatus->civil_status }}
                                            @endif
                                        </dd>
                                        <dt>Contact Number</dt>
                                        <dd>{{ $user->profile->mobile }}</dd>
                                            @endif
                                    </dl>
                                </div>
                                <div class="page-header"><h3>Academic Information</h3></div>
                                <div class="panel-body">
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
                                <div class="page-header"  style="margin-top: -40px"><h3>Personal Information</h3></div>
                                <div class="panel-body">
                                    <dl class="dl-horizontal">
                                        <dt>Name</dt>
                                        <dd>{{ $user->alumni->firstname.' '.$user->alumni->middlename.' '.$user->alumni->surname }}</dd>
                                        @if($user->profile != null)
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
                                        <dd>
                                            @if($user->profile->civilStatus != '0')
                                            {{ $user->profile->civilStatus->civil_status }}
                                                @endif
                                        </dd>
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
                                    @endif
                                    </dl>
                                </div>
                            </div>

                            <div id="academic" class="tab-pane">
                                <div class="page-header"  style="margin-top: -40px"><h3>Academic Information</h3></div>
                                <div class="panel-body">
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

                                <div class="page-header"><h3>Pre-University Information</h3></div>
                                <div class="panel-body">
                                    <dl class="dl-horizontal">
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
                                <div class="page-header"  style="margin-top: -40px"><h3>Employment Information</h3></div>
                                <div class="panel-body">
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
                                </div>
                            </div>

                            <div id="myPost" class="tab-pane">
                                <div class="page-header"  style="margin-top: -40px"><h3>My Post</h3></div>
                                <div class="panel-body">
                                    @if($user->posts->count() == 0)
                                        No Post Found
                                    @else
                                        @foreach($user->posts->sortByDesc('id')->take(4) as $post)
                                            <div class="card">
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
                                <div class="page-header"  style="margin-top: -40px"><h3>Eligibility</h3></div>
                                <div class="panel-body">
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
                                </div>
                            </div>

                            <div id="org" class="tab-pane">
                                <div class="page-header"  style="margin-top: -40px"><h3>Organizations</h3></div>
                                <div class="panel-body">
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
                                </div>
                            </div>

                            <div id="pub" class="tab-pane">
                                <div class="page-header"  style="margin-top: -40px"><h3>Publications</h3></div>
                                <div class="panel-body">
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
                                </div>
                            </div>

                            <div id="award" class="tab-pane">
                                <div class="page-header"  style="margin-top: -40px"><h3>Awards</h3></div>
                                <div class="panel-body">
                                    @if($user->awards->count() == 0)
                                        No Records Found
                                    @else
                                        <dl class="dl-horizontal">
                                            @foreach($user->awards as $award)
                                                <dt>Award</dt>
                                                <dd>{{ $award->award }}</dd>
                                                <dt>Date Given</dt>
                                                <dd>{{ date('M d, Y', strtotime($award->dategiven)) }}</dd>
                                                <hr>
                                            @endforeach
                                        </dl>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="panel-body">
                        <h3 class="page-header">
                            Directory List
                        </h3>
                        @foreach($alumni as $alum)
                            <div align="center" >
                                <a href="/alumni/view/{{ $alum->reg_id }}" style="color: #373737">
                                    @if($alum->user->picture == null)
                                        <img class="img-circle" width="40" height="40" src="{{ asset('storage/uploads/imgs/default.png') }}">
                                    @else
                                        <img class="img-circle" width="40" height="40" src="{{ asset('storage'.$alum->user->picture->location) }}">
                                    @endif
                                    <br>
                                    <strong style="font-size: 12px">{{ strtoupper($alum->firstname.' '.$alum->middlename.' '.$alum->surname) }}</strong>
                                </a>
                            </div>
                            <br>
                        @endforeach
                        <div align="center">
                            <a href="/alumni" class="btn-main">view more</a>
                        </div>
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
    <script>
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>

    <script src="{{ asset('js/tab.js') }}"></script>
@endsection