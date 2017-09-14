@php($u = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header"><h2>Member's Info</h2></div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div align="center" style="padding: 20px">
                        @if($user->picture == null)
                            <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage/uploads/imgs/default.png') }}">
                        @else
                            <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage'.$user->picture->location) }}">
                        @endif
                            <hr>
                        <dl>
                            <dt>Name</dt>
                            <dd>
                                @if($user->alumni->middlename == null)
                                    {{ $user->alumni->firstname.' '.$user->alumni->surname }}
                                @else
                                    {{ $user->alumni->firstname.' '.substr($user->alumni->middlename, 0, 1).'. '.$user->alumni->surname }}
                                @endif
                            </dd>
                            <dt>Student Number</dt>
                            <dd>{{ $user->alumni->student_number }}</dd>
                            <dt>College</dt>
                            <dd>{{ $user->alumni->college->college }}</dd>
                            <dt>Degree</dt>
                            <dd>{{ $user->alumni->degree->degree }}</dd>
                            <dt>Year Graduated</dt>
                            <dd>{{ $user->alumni->year_graduated }}</dd>
                        </dl>
                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="scroller scroller-left"><i class="glyphicon glyphicon-chevron-left"></i></div>
                    <div class="scroller scroller-right"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    <div class="wrapper">
                        <ul class="nav nav-tabs list" role="tablist" id="myTab">
                            <li role="presentation" class="active"><a href="#overview" aria-controls="home" role="tab" data-toggle="tab">Membership Details</a></li>
                            <li role="presentation"><a href="#personal" aria-controls="profile" role="tab" data-toggle="tab">Id card</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">

                        <div id="overview" class="tab-pane fade in active">
                            <div class="page-header col-md-offset-1"><h3>Details</h3></div>
                            <div class="panel-body">
                                @if($user->receipts == null)
                                    <div align="center">
                                        <button href="#" data-toggle="modal" data-target="#mem_info" class="button button-1a">Update</button>
                                    </div>
                                @else
                                <dl class="dl-horizontal">
                                    <dt>Membership Type</dt>
                                    <dd>
                                        @if($user->receipts->payment >= 1000)
                                                Lifetime Member
                                            @else
                                                Regular Member
                                            @endif
                                    </dd>
                                    <dt>OR Number</dt>
                                    <dd>{{ $user->receipts->orcode }}</dd>
                                    <dt>Date Paid</dt>
                                    <dd>{{ date('M d, Y', strtotime($user->receipts->datepaid)) }}</dd>
                                    <dt>Amount</dt>
                                    <dd>{{ $user->receipts->payment }}</dd>
                                    <dt>Effect Date</dt>
                                    <dd>{{ date('M d, Y', strtotime($user->alumni->effect_date )) }}</dd>
                                    <dt>Expiration Date</dt>
                                    <dd>{{ date('M d, Y', strtotime($user->alumni->due_date)) }}</dd>
                                    <dt>Card Status</dt>
                                    <dd>
                                        @if($user->alumni->idcard == 1)
                                            <strong style="color: green">Claimed</strong>
                                        @else
                                            <strong style="color: goldenrod">Unclaimed</strong>
                                        @endif
                                    </dd>
                                </dl>
                                    @endif

                            </div>
                        </div>

                        <div id="personal" class="tab-pane">
                            <div class="page-header col-md-offset-1"><h3>Details</h3></div>
                            <div class="panel-body col-md-offset-1">
                                @if($user->alumni->idcard == 0)
                                    <div align="center">
                                        <button href="#" data-toggle="modal" data-target="#claim" class="button button-1a">Claim ID Card</button>
                                    </div>
                                @else
                                    <dl class="dl-horizontal">
                                        <dt>Date Claimed</dt>
                                        <dd>{{ date('M d, Y', strtotime($user->alumni->dateclaimed)) }}</dd>
                                        <dt>Expiration Date</dt>
                                        <dd>{{ date('M d, Y', strtotime($user->alumni->due_date)) }}</dd>
                                        <dt>Card Status</dt>
                                        <dd>
                                            @if($user->alumni->idcard == 1 and $user->alumni->due_date < \Carbon\Carbon::now()->format('Y-m-d'))
                                                <strong style="color: red">Expired</strong>
                                            @elseif($user->alumni->idcard == 1 and $user->alumni->due_date > \Carbon\Carbon::now()->format('Y-m-d'))
                                                <strong style="color: green">Active</strong>
                                            @endif
                                        </dd>
                                        <dt>Name of Claimant/Representative</dt>
                                        <dd>{{ $user->alumni->claimed_by }}</dd>
                                    </dl>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mem_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #636363; color: white; font-weight: 600">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel4">Publications</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'admin/users/edit/'.$user->id , 'method' => 'post', 'class'=>'form-horizontal','role'=>'form']) }}
                    {{ Form::token() }}

                    <div class="form-group">
                        <label for="name" class="col-md-12">Official Receipt</label>
                        <div class="col-md-12">
                            {{Form::text('orcode', $user->alumni->or_code, ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-12">Date Paid</label>
                        <div class="col-md-12">
                            {{Form::text('date', date('M d, Y', strtotime($user->alumni->reg_date)), ['class' => 'datepicker form-control'])}}
                            <script type="text/javascript">
                                $('.datepicker').datepicker({
                                    format: 'M d, yyyy'
                                });
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-12">Amount</label>
                        <div class="col-md-12">
                            {{Form::text('amount', '', ['class' => 'form-control'])}}
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

    <div class="modal fade" id="claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #636363; color: white; font-weight: 600">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel3">Publications</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'admin/users/claim/'.$user->id , 'method' => 'post', 'class'=>'form-horizontal','role'=>'form']) }}
                    {{ Form::token() }}

                    <div class="form-group">
                        <label for="name" class="col-md-12">Date</label>
                        <div class="col-md-12">
                            {{Form::text('date', Carbon\Carbon::now()->format('M d, Y'), ['class' => 'datepicker form-control'])}}
                            <script type="text/javascript">
                                $('.datepicker').datepicker({
                                    format: 'M d, yyyy'
                                });
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-12">Name of Claimant/Representative</label>
                        <div class="col-md-12">
                            {{Form::text('name', '', ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-12">Card Validity</label>
                        <div class="col-md-12">
                            {{Form::text('dateEffect', Carbon\Carbon::now()->format('M d, Y'), ['class' => 'datepicker form-control'])}}
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
    @endsection