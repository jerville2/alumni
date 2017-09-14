@extends('layouts.app')

@section('hs')
    <style>
        .panel-heading .accordion-toggle:after {
            /* symbol for "opening" panels */
            font-family: 'Glyphicons Halflings';
            content: "\e114";
            float: right;
            color: darkgreen;
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
                        <div class="page-header"><h4><strong>ALUMNI HOMECOMING</strong></h4></div>

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel psolid">
                                <div class="panel-heading panelcolor" role="tab" id="news">
                                    <h4 class="panel-title fcolor" style="font-weight: bold">
                                        <a class="accordion-toggle collapsed" role="button " data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                            Reunions
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <table class="table table-condensed">
                                            @foreach(\App\Reunion::where('published', 1)->orderBy('reundate', 'desc')->take(7)->get() as $reun)
                                                <tr>
                                                    <td><h6><strong><a href="/reunion/{{ $reun->slug }}">{{ $reun->title }}</a></strong></h6>
                                                        <small>{{ date('F d, Y', strtotime($reun->reundate)) }}</small>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <h6>
                                                        <strong>
                                                            <a href="/reunions">More...</a>
                                                        </strong>
                                                    </h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('reun')
                </div>
            </div>
        </div>
    </div>
@endsection