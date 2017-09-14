@extends('layouts.reg')

@section('hs')
    @yield('sss')
    <style>
        .panel-heading .accordion-toggle:after {
            /* symbol for "opening" panels */
            font-family: 'Glyphicons Halflings';
            content: "\e114";
            float: right;
            color: green;
        }
        .panel-heading .accordion-toggle.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\e080";
        }
         .g{
             margin-top: 0;
             margin-bottom: 40px;
         }
        .rc {
            position: relative;
        }
        .r {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .rc .s {
            line-height: 18px;
        }
        .st {
            line-height: 1.2;
            word-wrap: break-word;
        }
        .kv {
            height: 18px;
            line-height: 16px;
        }
    </style>
    @endsection

@section('carousel')
    <div class="carousel-profile"></div>
    <div class="container">
        <div class="card">

            <div class="row">
                <div class="col-md-3">
                    <div class="col-md-12">
                        <div class="page-header"><h4><strong>CONTENT CATEGORIES</strong></h4></div>

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel psolid">
                                <div class="panel-heading panelcolor" role="tab" id="news">
                                    <h4 class="panel-title fcolor" style="font-weight: bold">
                                        <a class="accordion-toggle collapsed" role="button " data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                            News
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <table class="table table-condensed">
                                            @foreach(\App\News::where('published', 1)->latest('date')->take(5)->get() as $new)
                                                <tr>
                                                    <td><h6><strong><a href="/news/{{ $new->slug }}">{{ $new->headline }}</a></strong></h6>
                                                        <small>{{ date('F d, Y', strtotime($new->date)) }}</small>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <h6>
                                                        <strong>
                                                            <a href="/news">More...</a>
                                                        </strong>
                                                    </h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="panel psolid">
                                <div class="panel-heading panelcolor" role="tab" id="news">
                                    <h4 class="panel-title fcolor" style="font-weight: bold">
                                        <a class="accordion-toggle collapsed" role="button " data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            Events/Activities
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <table class="table table-condensed">

                                            @foreach(\App\Event::where('published', 1)->latest('date')->take(5)->get() as $eve)
                                                <tr>
                                                    <td><h6><strong><a href="/events/{{ $eve->slug }}">{{ $eve->title }}</a></strong></h6>
                                                        <small>{{ date('F d, Y', strtotime($eve->date)) }}</small>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <h6>
                                                        <strong>
                                                            <a href="/events">More...</a>
                                                        </strong>
                                                    </h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="panel psolid">
                                <div class="panel-heading panelcolor" role="tab" id="news">
                                    <h4 class="panel-title fcolor" style="font-weight: bold">
                                        <a class="accordion-toggle collapsed" role="button " data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            Announcement
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingthree">
                                    <div class="panel-body">
                                        <table class="table table-condensed">

                                            @foreach(\App\Announcement::where('published', 1)->latest('date')->take(5)->get() as $ann)
                                                <tr>
                                                    <td><h6><strong><a href="/announcement/{{ $ann->slug }}">{{ $ann->title }}</a></strong></h6>
                                                        <small>{{ date('F d, Y', strtotime($ann->date)) }}</small>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <h6>
                                                        <strong>
                                                            <a href="/announcements">More...</a>
                                                        </strong>
                                                    </h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @if (Auth::guest() or Auth::user()->verified == 0)
                                <div class="panel psolid">
                                    <div class="panel-heading panelcolor">
                                        <h4 class="panel-title fcolor">
                                            <a class="accordion-toggle collapsed" href="{{ route('login') }}">
                                                Job Opportunities
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel psolid">
                                    <div class="panel-heading panelcolor">
                                        <h4 class="panel-title fcolor">
                                            <a class="accordion-toggle collapsed" href="{{ route('login') }}">
                                                Gallery
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                @else

                                <div class="panel psolid">
                                    <div class="panel-heading panelcolor" role="tab" id="news">
                                        <h4 class="panel-title fcolor" style="font-weight: bold">
                                            <a class="accordion-toggle collapsed" role="button " data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse3">
                                                Job Opportunities
                                            </a>
                                        </h4>
                                    </div>

                                    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingthree">
                                        <div class="panel-body">
                                            <table class="table table-condensed">

                                                @foreach(\App\Opportunity::where('published', 1)->latest('date')->take(5)->get() as $opp)
                                                    <tr>
                                                        <td><h6><strong><a href="/jobs/{{ $opp->slug }}">{{ $opp->title }}</a></strong></h6>
                                                            <small>{{ date('F d, Y', strtotime($opp->date)) }}</small>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>
                                                        <h6>
                                                            <strong>
                                                                <a href="/jobs">More...</a>
                                                            </strong>
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel psolid">
                                    <div class="panel-heading panelcolor">
                                        <h4 class="panel-title fcolor">
                                            <a class="accordion-toggle collapsed" href="/gallery">
                                                Gallery
                                            </a>
                                        </h4>
                                    </div>
                                </div>

                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('news')
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
@endsection