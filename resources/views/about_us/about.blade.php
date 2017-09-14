@extends('layouts.reg')
@section('hs')
    <style>
        strong{
            font-weight:bold; font-size:12px;
        }
        i{
            font-size: 12px;
        }
        .tabs-left, .tabs-right {
            border-bottom: none;
            padding-top: 2px;
        }
        .tabs-left {
            border-right: 1px solid #ddd;
        }
        .tabs-left>li, .tabs-right>li {
            float: none;
            margin-bottom: 2px;
        }
        .tabs-left>li {
            margin-right: -1px;
        }

        .tabs-left>li>a {
            border-radius: 4px 0 0 4px;
            margin-right: 0;
            display:block;
        }

        .nav-tabs.tabs-left { border-right: 2px solid #DDD; }
        .nav-tabs.tabs-left > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
        .nav-tabs.tabs-left > li > a { border: none; color: #666; }
        .nav-tabs.tabs-left > li.active > a, .nav-tabs > li > a:hover { border-right:4px solid #2c9f03 !important; background: transparent; }
        .nav-tabs.tabs-left > li > a::after { content: ""; border-right:4px solid #2c9f03; height: 0px; position: absolute; width: 100%; top: 0px; right: -1px; transition: all 250ms ease 0s; transform: scale(0); }
        .nav-tabs.tabs-left > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
    </style>
    <script>
        $(document).ready(function () {
            $('#myTabs a[href="#{{ old('tab') }}"]').tab('show')
        });
    </script>
@endsection
@section('carousel')
    <div class="carousel-profile"></div>
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-md-3">
                    <div class="col-md-12">
                        <div class="page-header"><h4>ABOUT US</h4></div>
                        <ul class="nav nav-tabs tabs-left" role="tablist" id="myTabs">
                            <li role="presentation" class="active"><a href="#mission" aria-controls="home" role="tab" data-toggle="tab">Mission and Objectives</a></li>
                            <li role="presentation"><a href="#organization" aria-controls="profile" role="tab" data-toggle="tab">Organizational Structure</a></li>
                            <li role="presentation"><a href="#coordinators" aria-controls="messages" role="tab" data-toggle="tab">Coordinators</a></li>
                            <li role="presentation"><a href="#faai" aria-controls="settings" role="tab" data-toggle="tab">FAAI Officers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div id="mission" class="tab-pane fade in active">
                            <div class="col-md-9 col-md-offset-1">
                                <h1 class="page-header">Mission and Objectives</h1>
                                <h3>Mission</h3>
                                <p>The Alumni Relations Office exists to enhance professional and social networking between the university and its alumni and friends.</p>
                                <h3>Objectives</h3>
                                <p>
                                <ul>
                                    <li>To ensure quality service for the MMSU and alumni</li>
                                    <li>To project positive image of the university to its alumni and friends; and</li>
                                    <li>To maintain loyalty and support of the alumni to the university's program and projects</li>
                                </ul>
                                </p>
                                <hr style="margin: 100px">
                            </div>
                        </div>

                        <div id="organization" class="tab-pane">
                            <div align="center">
                                <h1 class="page-header">Organizational Structure</h1>
                                <div class="col-md-12">
                                    <img width="720" src="{{ asset('storage/uploads/articles/org_struc_gif.gif') }}">
                                    <div class="uk-thumbnail-caption">Organizational Structure</div>
                                    <hr style="margin: 100px">
                                </div>
                            </div>
                        </div>

                        <div id="coordinators" class="tab-pane">
                            <article style="background-image:url('storage/uploads/articles/coordinators/Picture22.png'); background-position:center; background-repeat:no-repeat;">
                                <h1 align="center">MMSU Alumni Relations Office</h1>
                                <div style="margin-top:40px;" align="center">
                                    <div>
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/ctragual.jpg') }}">
                                        <p>
                                            <strong>PROF. CIRIACO T. RAGUAL</strong>
                                            <br>
                                            <i>Chief, Alumni Relations</i>
                                        </p>
                                    </div>
                                </div>

                                <h1 align="center">Alumni Coordinators 2015-2017</h1>
                                <div class="row" align="center" style="margin-top: 40px">
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/ilnajorda.jpg')}}">
                                        <p>
                                            <strong>IMELDA L. NAJORDA</strong>
                                            <br>
                                            <i>Graduate School</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/15.jpg')}}">
                                        <p>
                                            <strong>ROSABEL L. ACOSTA</strong>
                                            <br>
                                            <i>CTE - Tertiary</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/21.jpg')}}">
                                        <p>
                                            <strong>CHRISTY ANN M. RAHON</strong>
                                            <br>
                                            <i>CTE - LHS</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/ngalatira.jpg')}}">
                                        <p>
                                            <strong>NORMA T. GALARITA</strong>
                                            <br>
                                            <i>LES Laoag</i>
                                        </p>
                                    </div>
                                </div>
                                <div class="row" align="center" style="margin-top: 40px">
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/13.jpg')}}">
                                        <p>
                                            <strong>WILLIAM G. BERMUDEZ</strong>
                                            <br>
                                            <i>CIT</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/16.jpg')}}">
                                        <p>
                                            <strong>MA. TEREZA A. BLANCO</strong>
                                            <br>
                                            <i>CAS</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/imgs/default.png')}}">
                                        <p>
                                            <strong>ROSELLE Y. MAMUAD</strong>
                                            <br>
                                            <i>COE</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/17.jpg')}}">
                                        <p>
                                            <strong>JOSEPHINE P. CERIA</strong>
                                            <br>
                                            <i>CHS</i>
                                        </p>
                                    </div>
                                </div>
                                <div class="row" align="center" style="margin-top: 40px">
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/imgs/default.png')}}">
                                        <p>
                                            <strong>EMIL JAMES P. TANAGON</strong>
                                            <br>
                                            <i>CBEA</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/imgs/default.png')}}">
                                        <p>
                                            <strong>GENEVIEVE I. MAGANO</strong>
                                            <br>
                                            <i>CAFSD - Batac</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/srdemandante.jpg')}}">
                                        <p>
                                            <strong>SOSIMA R. DEMANDANTE</strong>
                                            <br>
                                            <i>CAFSD - Dingras</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/imgs/default.png')}}">
                                        <p>
                                            <strong>ERLYN S. ALLADO</strong>
                                            <br>
                                            <i>CASAT</i>
                                        </p>
                                    </div>
                                </div>
                                <div class="row" align="center" style="margin-top:40px;">
                                    <div class="col-md-3">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/coordinators/20.jpg')}}">
                                        <p>
                                            <strong>MIGNON CECILIA S. DIEGO</strong>
                                            <br>
                                            <i>UHS - Batac</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/imgs/default.png')}}">
                                        <p>
                                            <strong>MS. MAYFLOR C. RIVERA</strong>
                                            <br>
                                            <i>LES - Batac</i>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row" align="center" style="margin-top:40px;">
                                    <div>
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/imgs/default.png')}}">
                                        <p>
                                            <strong>MICHELLE A. OMEGA</strong>
                                            <br>
                                            <i>Support Staff</i>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div id="faai" class="tab-pane">
                            <article class="uk-article" style="background-image:url('storage/uploads/articles/faai-officers/Picture21.png'); background-position:center; background-repeat:no-repeat;">

                                <h2>MMSU Federated Alumni Association, Inc. (2015-2018)</h2>
                                <div class="row" style="margin-top:40px;">
                                    <div align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/1.jpg')}}">
                                        <p>
                                            <strong>HON BISMARK ANGELO A. QUIDANG</strong>
                                            <br>
                                            <strong>President</strong>
                                            <br>
                                            Science High School - Batac (1994)
                                            <br>
                                            BS in Business Administration - Management Accounting (1999)
                                        </p>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:40px;">
                                    <div class="col-md-6" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/10.jpg')}}">
                                        <p>
                                            <strong style="font-weight:bold; font-size:12px;">MR LEONARDO T. PASCUA</strong>
                                            <br>
                                            <strong>Vice - President</strong>
                                            <br>
                                            BS in Agriculture (1980)
                                        </p>
                                    </div>
                                    <div class="col-md-6" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/8.jpg')}}">
                                        <p>
                                            <strong>PROF. RYAN DEAN T. SUCGANG</strong>
                                            <br>
                                            <strong>Secretary</strong>
                                            <br>
                                            Science High School - Batac (1994)
                                            <br>
                                            BS in Physical Therapy (1999)
                                        </p>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:40px;">
                                    <div class="col-md-4" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/4.jpg')}}">
                                        <p>
                                            <strong>PROF. JANET F. RIVERA</strong>
                                            <br>
                                            <strong>Treasurer</strong>
                                            <br>
                                            Bachelor in Secondary Education (1991)
                                            <br>
                                            Master of Arts in Education (2001)
                                        </p>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/22.jpg')}}">
                                        <p>
                                            <strong>PROF. SUERTE MONINA R. DY</strong>
                                            <br>
                                            <strong>Auditor</strong>
                                            <br>
                                            Laboratory High School - Batac (1982)
                                            <br>
                                            BS in Business Administration - Accounting (1986)
                                        </p>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/nlagmay.jpg')}}">
                                        <p>
                                            <strong>MS NORMA B. LAGMAY</strong>
                                            <br>
                                            <strong>Public Information Officer</strong>
                                            <br>
                                            BS in Agriculture (1977)
                                        </p>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:40px;">
                                    <div class="col-md-4" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/7.jpg')}}">
                                        <p>
                                            <strong>SBM MAYNARD FRANCIS R. BUMANGLAG</strong>
                                            <br>
                                            <strong>Business Manager</strong>
                                            <br>
                                            BS in Economics (1998)
                                        </p>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/6.jpg')}}">
                                        <p>
                                            <strong>DR. TEODORICO S. PARBO JR.</strong>
                                            <br>
                                            <strong>Peace Officer</strong>
                                            <br>
                                            BS in Agriculture (1979)
                                            <br>
                                            Doctor of Philosophy - Rural Development (2002)
                                        </p>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/meejay.jp')}}g">
                                        <p>
                                            <strong>DR MEE JAY A. DOMINGO</strong>
                                            <br>
                                            <strong>Peace Officer</strong>
                                            <br>
                                            AB English Studies (2005)
                                            <br>
                                            Master of Arts in English, Language and Literature (2011)
                                            <br>
                                            Doctor of Philosophy – Applied Linguistics (2015)
                                        </p>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:40px;">
                                    <div align="center">
                                        <img width="100" class="img-circle" src="{{ asset('storage/uploads/articles/faai-officers/2.jpg')}}">
                                        <p>
                                            <strong>ARCELI C. SALVADOR</strong>
                                            <br>
                                            <strong>Support Staff</strong>
                                            <br>
                                            BS in Computer Science (2011)
                                        </p>
                                    </div>
                                </div>
                            </article>

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

@endsection