@extends('layouts.app')
@section('carousel')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators" style="margin-bottom: -5px">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            @foreach($slides as $slide)
            <li data-target="#myCarousel" data-slide-to="{{$loop->index+1}}"></li>
                @endforeach
        </ol>
        <!-- asset('storage/uploads/slides/aro-main.jpg')-->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img class="img-responsive" src="{{asset('storage/uploads/slides/aro-main.jpg') }}" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        @if (Auth::guest())
                            <h1>Welcome to the MMSU Alumni Relations</h1>
                            <p>To access the Alumni Directory, Gallery, Graduate Tracer Study, edit your Profile and Job board, please login to your account. Not yet a member? Click the button below to join.</p>
                            <p><a class="bttn" href="{{ route('register') }}" role="button">Register</a></p>
                        @else
                            <h1>My Profile</h1>
                            <p>View/Edit your Profile now</p>
                            <p><a class="bttn" href="/my_profile" role="button">My Profile</a></p>
                        @endif
                    </div>
                </div>
            </div>
            @foreach($slides as $slide)
            <div class="item">
                <img class="second-slide" src="{{ asset('storage'.$slide->location) }}" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <p>{{ $slide->title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container">
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panelcolor" style=""><span><i class="glyphicon glyphicon-bullhorn"></i> </span> Activities and Events</div>
                                <div class="panel-body">
                                    <dl>
                                        @foreach($events as $event)
                                            <dt><h6><strong><a href="events/{{ $event->slug }}">{{ $event->title }}</a></strong></h6></dt>
                                            <dd><small>{{ date('F d, Y', strtotime($event->date)) }}</small></dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                    <p><a class="btn-def" href="events" role="button">View More &raquo;</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panelcolor" style=""><span><i class="glyphicon glyphicon-bullhorn"></i> </span> Reunions</div>
                                <div class="panel-body">
                                    <dl>
                                        @foreach($reunions as $event)
                                            <dt><h6><strong><a href="reunion/{{ $event->slug }}">{{ $event->title }}</a></strong></h6></dt>
                                            <dd><small>{{ date('F d, Y', strtotime($event->reundate)) }}</small></dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                    <p><a class="btn-def" href="reunions" role="button">View More &raquo;</a></p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-md-6">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panelcolor"><span><i class="glyphicon glyphicon-bullhorn fcolor"></i> </span> News Features</div>
                                <div class="panel-body">
                                    <dl>
                                        @foreach($news as $new)
                                            <dt><h6><strong><a href="news/{{ $new->slug }}">{{ $new->headline }}</a></strong></h6></dt>
                                            <dd><small>{{ date('F d, Y', strtotime($new->date)) }}</small></dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                    <p><a class="btn-def" href="news" role="button">View More &raquo;</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panelcolor"><span><i class="glyphicon glyphicon-bullhorn fcolor"></i> </span> Announcements</div>
                                <div class="panel-body">
                                    <dl>
                                        @foreach($announcements as $new)
                                            <dt><h6><strong><a href="announcement/{{ $new->slug }}">{{ $new->title }}</a></strong></h6></dt>
                                            <dd><small>{{ date('F d, Y', strtotime($new->date)) }}</small></dd>
                                            <hr>
                                        @endforeach
                                    </dl>
                                    <p><a class="btn-def" href="announcements" role="button">View More &raquo;</a></p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col-lg-4 -->
                </div>

            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="panelcolor"><span><i class="glyphicon glyphicon-list"></i></span> Alumni Directory</div>
                            <div class="panel-body">
                                <form action="alumni/qAlumni" method="get" class="input-group">
                                    <label for="search" class="sr-only">Search</label>
                                    <input type="text" class="form-control" name="search" id="search" placeholder="Search Alumni" required/>
                                    <span class="input-group-btn">
                                            <button class="btn" type="submit" style="background: linear-gradient(to right, darkgreen 50%, #99cc00 ); color: gold;">
                                                <i class="fcolor glyphicon glyphicon-search"></i>
                                            </button>
                                        </span>
                                </form>
                                <div class="row" style="margin-top: 12px">
                                    <div class="col-md-4">
                                        <img class="img-responsive" src="{{ asset('storage/uploads/articles/user.png') }}">
                                    </div>
                                    <div class="col-md-8">
                                        <strong>Be Found:</strong>
                                        <p style="text-align: justify">
                                            Keep your profile up-to-date. Share your story, interests, and past employment.
                                        </p>
                                    </div>
                                </div>
                                <hr style="margin: 5px">
                                <div align="center">
                                    <a href="alumni/home"><span><i class="glyphicon glyphicon-level-up"></i> </span> BROWSE DIRECTORY </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="panelcolor"><span><i class="glyphicon glyphicon-cog"></i> </span> Alumni Tools</div>
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        @if(!Auth::guest())
                                            <td><a href="{{route('gts',['id'=>Auth::user()->id,'c'=>1])}}">
                                                    <span>
                                                        <i class="glyphicon glyphicon-education"></i>
                                                    </span> Graduate Tracer Study REnz
                                                </a>
                                            </td>
                                        @else
                                            <td><a  href="{{route('gts',['id'=>1,'c'=>1])}}">
                                                    <span>
                                                        <i class="glyphicon glyphicon-education"></i>
                                                    </span> Graduate Tracer Study
                                                </a>
                                            </td>
                                        @endif

                                    </tr>
                                    <tr>
                                        <td><a href="jobs"><span><i class="glyphicon glyphicon-briefcase"></i> </span> Job Board</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="gallery"><span><i class="glyphicon glyphicon-picture"></i> </span> Gallery</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="panelcolor"><span><i class="glyphicon glyphicon-download-alt"></i> </span> Alumni Downloads</div>
                            <div class="panel-body">
                                <table class="table">
                                    @foreach($downloads as $dl)
                                        <tr>
                                            <td>
                                                <a href="download/{{ $dl->dl_code }}"><span><i class="glyphicon glyphicon-save-file"></i></span> {{ $dl->title }}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection