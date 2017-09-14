@extends('layouts.reg')
@section('hs')
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <style>
        .qwe{
            height:100px;
            min-height:100px;
            max-height:100px;
        }
        .btn-group-justified > div.btn-group>a{
            border-bottom: solid 2px #a0a0a0;
            font-weight: 600;
        }
        .btn-group-justified > div.active >a{
            color: #2ca02c;
            border-bottom: solid 2px #2ca02c;
            background: whitesmoke;
        }
    </style>
    @yield('sss')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="/alumni/qAlumni" method="get" class="form-horizontal">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="input-group">
                            <label for="search" class="sr-only">Search</label>
                            @if (Session::get($value)['deg'] != null)
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search Alumni" value="{{ Session::get($value)['sch'] }}" />
                            @else
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search Alumni" value="{{ Session::get($value)['sch'] }}" />
                            @endif
                            <span class="input-group-btn">
                                <button class="btn" type="submit" style="background: linear-gradient(to right, darkgreen 50%, #99cc00 ); color: gold;">
                                    <i class="fcolor glyphicon glyphicon-search"></i>
                                </button>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="checkbox" autocomplete="off" id="checkbox1">
                                            <i class="glyphicon glyphicon-filter"></i> Filter
                                    </label>
                                </div>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-offset-3" align="center" style="margin-bottom: 30px">
                        <div class="row">
                            <div id="autoUpdate" hidden>
                                <hr style="margin: 10px">
                                <select id="collegeList" name="college" class="btn btn-mini">
                                    @if (Session::get($value)['col'] != null)
                                        <option value="{{ Session::get($value)['col'] }}">{{ Session::get($value)['coln'] }}</option>
                                    @endif
                                    <option value="">-- Any College --</option>
                                    @foreach($colleges as $college)
                                        <option  value="{{$college->college_code}}">{{$college->college}}</option>
                                    @endforeach
                                </select>

                                <select id="degreeList" name="degree" class="btn btn-mini">
                                    @if (Session::get($value)['deg'] != null)
                                        <option value="{{ Session::get($value)['deg'] }}">{{ Session::get($value)['degn'] }}</option>
                                        <option value="">-- Any Degree --</option>
                                        @foreach($degrees as $degree)
                                            <option  value="{{$degree->id}}">{{$degree->abbr}}</option>
                                        @endforeach
                                    @else
                                        <option value="">-- Any Degree --</option>
                                        @if (Session::get($value)['col'] != null)
                                            @foreach($degrees as $degree)
                                                <option  value="{{$degree->id}}">{{$degree->abbr}}</option>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>

                                <select name="year" class="btn btn-mini">
                                    @if (Session::get($value)['yr'] != null)
                                        <option>{{ Session::get($value)['yr'] }}</option>
                                    @endif
                                    <option value="">Any Year</option>
                                    <?=
                                    $date2=date('Y', strtotime('-1 Years'));
                                    for($i=date('Y'); $i>$date2-47;$i--){
                                        echo '<option>'.$i.'-'.($i+1).'</option>';
                                    } ?>
                                </select>

                                <select name="sem" class="btn btn-mini">
                                    @if (Session::get($value)['sem'] != null)
                                        <option value="{{ Session::get($value)['sem'] }}">{{ Session::get($value)['semn'] }}</option>
                                    @endif
                                    <option value="">Any sem</option>
                                    <option value="1">1st Sem.</option>
                                    <option value="2">2nd Sem.</option>
                                    <option value="3">Midyear</option>
                                </select>
                                <hr style="margin: 5px">
                                <input  class="btn btn-default btn-sm" type="submit" value="Apply Filter" />
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function(){
                            $('#checkbox1').change(function(){
                                if(this.checked)
                                    $('#autoUpdate').slideDown();
                                else
                                    $('#autoUpdate').slideUp();

                            });
                        });
                        $("#search").keyup(function(){
                            update();
                        });

                        function update() {
                            $("#result").val($('#search').val());
                        }

                    </script>
                </form>
            </div>
            <div class="col-md-6 col-md-offset-3" style="margin-top: -15px; margin-bottom: 15px">
                <div class="btn-group btn-group-justified" role="group" style="border-radius: 0!important;">
                    <div class="btn-group {{ $h or '' }}" role="group">
                        <a href="/alumni/home" type="button" class="btn btn-default" style="border-radius: 0!important;">Directory Home</a>
                    </div>
                    <div class="btn-group {{ $l or '' }}" role="group">
                        <a href="/alumni" type="button" class="btn btn-default">Directory List</a>
                    </div>
                    <div class="btn-group {{ $p or '' }}" role="group">
                        <a href="/my_profile/myPost" type="button" class="btn btn-default"style="border-radius: 0!important;">My Post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('directory')
@endsection
@section('fs')
    @yield('ss')
    @endsection