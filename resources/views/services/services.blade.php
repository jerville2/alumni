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
                        <div class="page-header"><h4>SERVICES</h4></div>
                        <ul class="nav nav-tabs tabs-left" role="tablist" id="myTabs">
                            <li role="presentation" class="active"><a href="#balik" aria-controls="home" role="tab" data-toggle="tab">Balik-Alumni</a></li>
                            <li role="presentation"><a href="#idcard" aria-controls="profile" role="tab" data-toggle="tab">Alumni ID Card</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div id="balik" class="tab-pane fade in active">
                            <div class="col-md-11">
                                <article>
                                    <h1 class="page-header">Balik-Alumni Program</h1>

                                    <div align="justify">
                                        <!-- Article Content -->
                                        <div align="justify">
                                            <div>
                                                <div>
                                                    <img width="400" src="/uploads/articles/541796501a01f-balikalumni.jpg" style="float:right;">
                                                    <p><strong>Balik-Alumni Program</strong> is one of the programs of the Alumni Relations Office which primarily involves successful and accomplished alumni who come back to their Alma Mater and share their love and services in different ways.</p>
                                                    <p>The program aims to:</p>
                                                    <ol>
                                                        <li>strengthen the linkages between the alumni and the university;</li>
                                                        <li>strengthen the role of the alumni in the attainment of the objectives of the MMSU Federated Alumni Association Inc. and the Alumni Relations Office;</li>
                                                        <li>promote interaction among alumni of the university;</li>
                                                        <li>tap alumni to support/assist the projects and programs of the Alumni Relations Office and</li>
                                                        <li>collaborate with alumni to carry out the mission of the university</li>
                                                    </ol>
                                                    <p>The alumni can offer the following services, among others, in BAP.</p>
                                                    <ol>
                                                        <li>They can become speakers, trainers, lecturers or demonstrators of relevant issues, concerns and strategies which could benefit the current students, faculty members and administrators and other alumni of the university.</li>
                                                        <li>They can even share books, reading materials, instructional materials for the students and teachers.</li>
                                                        <li>They can become benefactors/ sponsors of our financially incapable students through the scholarship program of the Alumni Relations Office.</li>
                                                        <li>They can become donors of cash to support the activities and programs of the office.</li>
                                                        <li>They can become donors of facilities or equipment for instructional purposes, recreational or for general purposes which may benefit the students, faculty and alumni of the college.</li>
                                                        <li>They too, can become the university's linkage to other  agencies/institutio ns who can offer similar services.</li>
                                                    </ol>
                                                    <p>The alumni can share their blessings through this program as many times as they can and as many ways as possible.</p>
                                                    <p>The reward of the Balik-alumni who generously respond to the program is a Certificate or Plaque of Recognition. Their names and noble services shall be recorded and documented as a permanent record of their love and generosity for their Alma Mater.</p>
                                                </div>
                                                <div>
                                                    Email add: <a href="mailto:mmsu_alumni@yahoo.com">mmsu_alumni@yahoo.com</a>
                                                    <br>
                                                    Tel #:   (077) 792-4159 loc 146
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </article>

                                <hr style="margin: 100px">
                            </div>
                        </div>

                        <div id="idcard" class="tab-pane">
                            <div class="col-md-11">
                                <article class="uk-article">
                                    <h1 class="page-header">Alumni ID Card</h1>

                                    <div align="justify">
                                        <div align="justify">
                                            <p>With the aim that there should be a formal identification scheme for all alumni which will entitle them to campus access, discounts and benefits, an <strong>Alumni ID Card Program</strong> was conceptualized and to be implemented this  April, 2010.</p>
                                            <h3>Types of Cards and Benefits/Privileges</h3>
                                            <div>
                                                <table class="table">
                                                    <tbody><tr>
                                                        <td width="200" valign="top">Type of Alumni ID Card</td>
                                                        <td valign="top">Lifetime Membership Card (Gold)</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Qualifications of Card Holder</td>
                                                        <td valign="top">Alumni who paid (Php 1,000) lifetime membership fee</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Processing Cost of New card</td>
                                                        <td valign="top">Php 150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Card Replacement Fee</td>
                                                        <td valign="top">Php 150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Period of Card Validity</td>
                                                        <td valign="top">Five (5) years</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Benefits/Privileges</td>
                                                        <td valign="top">
                                                            Access and 5% discount in the availment or use of university resources such as buildings, facilities and equipment. It includes the use of the ff.:
                                                            <ul>
                                                                <li>PT Rhabilitation Center</li>
                                                                <li>Accommodation for Rentals</li>
                                                                <li>Sports facilities</li>
                                                                <li>Swimming Pool</li>
                                                                <li>Mansion</li>
                                                                <li>Cottage in Currimao</li>
                                                                <li>Teatro Ilocandia</li>
                                                                <li>Function Hall</li>
                                                                <li>University Training Center</li>
                                                                <li>Library Resources (Free access)</li>
                                                            </ul>
                                                            *Discount in selected business owned by alumni
                                                        </td>
                                                    </tr>
                                                    </tbody></table>
                                                <br>
                                                <table class="table">
                                                    <tbody><tr>
                                                        <td width="200" valign="top">Type of Alumni ID Card</td>
                                                        <td valign="top">Regular Membership card</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Qualifications of Card Holder</td>
                                                        <td valign="top">Alumni who paid annual due (Php 100)
                                                            Associate members (anyone who studied in the university and its predecessor schools for at least two years and willing to become a member of the alumni association by paying annual due of (Php 100)</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Processing Cost of New card</td>
                                                        <td valign="top">Php 150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Card Replacement Fee</td>
                                                        <td valign="top">Php 150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Period of Card Validity</td>
                                                        <td valign="top">Two (2) years</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Benefits/Privileges</td>
                                                        <td valign="top">
                                                            Access and 5% discount in the availment or use of university resources such as buildings, facilities and equipment. It includes the use of the ff.:
                                                            <ul>
                                                                <li>PT Rhabilitation Center</li>
                                                                <li>Accommodation for Rentals</li>
                                                                <li>Sports facilities</li>
                                                                <li>Swimming Pool</li>
                                                                <li>Mansion</li>
                                                                <li>Cottage in Currimao</li>
                                                                <li>Teatro Ilocandia</li>
                                                                <li>Function Hall</li>
                                                                <li>University Training Center</li>
                                                                <li>Library Resources (Free access)</li>
                                                            </ul>
                                                            *Discount in selected business owned by alumni
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin: 80px">
                                </article>
                            </div>
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