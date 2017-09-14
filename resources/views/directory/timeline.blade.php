@php($h = 'active')
@extends('directory.directory')
@section('sss')
    <style>
        #snackbar {
            visibility: hidden;
            max-width: 250px;
            margin-left: -125px;
            background-color: darkgreen;
            color: #fff;
            font-weight: bold;
            text-align: center;
            border-radius: 0px;
            padding: 5px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 80px;
        }
        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 80px; opacity: 1;}
        }
        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 80px; opacity: 1;}
        }
        @-webkit-keyframes fadeout {
            from {bottom: 80px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
        @keyframes fadeout {
            from {bottom: 80px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        .btn{
            !important; border-radius: 0px;
        }
        .btn.active {
            display: none;
            border-radius: 0px;
        }

        .btn span:nth-of-type(1)  {
            display: none;
            border-radius: 0px;
        }
        .btn.active span:last-child  {
            display: none;
            border-radius: 0px;
        }
    </style>
    @endsection
@section('directory')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="panel-body">
                        <div align="center">
                            <div class="conten">
                                @if(Auth::user()->picture == null)
                                    <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage/uploads/imgs/default.png') }}">
                                @else
                                    <img class="img-thumbnail" width="220" height="220" src="{{ asset('storage'.Auth::user()->picture->location) }}">
                                @endif
                            </div>
                        </div>
                        <hr>
                        <ul class="nav nav-tab" role="tablist">
                            <li style="margin-bottom: -1px"><a class="buttonmini" href="/my_profile">My profile</a></li>
                            <li style="margin-bottom: -1px">
                                <a class="buttonmini" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                        <hr>
                        <div align="center">
                            <strong>Post Something</strong><br>
                            Share your story, interests, and past employment.
                            <hr>
                            <a class="btn-main" href="#" data-toggle="modal" data-target="#post">post</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                @if ($posts->count() > 0)
                    <div class="infinite-scroll">
                        @foreach($posts as $post)
                            <div class="card2" id="{{$post->id}}">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" type="button" data-toggle="dropdown" href="#">
                                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#report" data-whatever="{{ $post->id }}">Report</a></li>
                                    </ul>
                                </div>
                                <div class="panel-heading">
                                    <a href="/alumni/view/{{ $post->user->id }}">
                                        @if($post->user->picture == null)
                                            <img class="img-circle pull-left" src="{{ asset('storage/uploads/imgs/default.png') }}" width="50px" height="50px" />
                                        @else
                                            <img class="img-circle pull-left" src="{{ asset('storage'.$post->user->picture->location) }}" width="50px" height="50px" />
                                        @endif
                                        <h3>{{ $post->user->alumni->firstname.' '.$post->user->alumni->middlename.' '.$post->user->alumni->surname }}</h3>
                                    </a>
                                    <h5><span>Shared</span> - <span>{{ date('M d, Y  h:i:s a', strtotime($post->date)) }}</span> </h5>
                                </div>
                                @if($post->report == 0)
                                    <div class="panel-body" style="top: 5px">
                                        <h2><strong>{{ $post->title }}</strong></h2>
                                        @if(str_word_count($post->post) > 60)
                                            <div class="show">
                                                <input id="ch{{$post->id}}" type="checkbox">
                                                <label for="ch{{$post->id}}"></label>
                                                <div class="text" align="justify">
                                                    {!! $post->post !!}
                                                </div>
                                            </div>
                                        @else
                                            <div align="justify">
                                                {!! $post->post !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="panel-footer" style="margin-top: 20px">
                                        @if($post->likes->count() > 0 and $post->likes()->whereRegId(Auth::user()->id)->first())
                                            @if($post->likes->count() -1 == 0)
                                                <p><small><strong>You</strong> Like this.</small></p>
                                                @else
                                                <p><small><strong>You</strong> and {{ $post->likes->count() -1 }} others Like this.</small></p>
                                                @endif
                                            @elseif($post->likes->count() > 0)
                                            <p><small>{{ $post->likes->count() }} Likes</small></p>
                                        @endif

                                        @if ($post->likes()->whereRegId(Auth::user()->id)->first())
                                                <div class="" data-toggle="buttons" onclick="postId('{{ route('post.like', [$post->id, $post->reg_id]) }}')">
                                                    <label class="btn btn-main-active">
                                                        <input type="radio" autocomplete="off" style="!important border-radius: 0px">
                                                        <i class="glyphicon glyphicon-thumbs-up"></i>
                                                    </label>
                                                    <label class="btn btn-main active">
                                                        <input type="radio" autocomplete="off"  checked style="!important border-radius: 0px">
                                                        <i class="glyphicon glyphicon-thumbs-up"></i>
                                                    </label>
                                                    <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/alumni/post/'.$post->id) }}&display=popup','MyWindow',width=600,height=300); return false;">
                                                        <span class="glyphicon glyphicon-share-alt">share</span>
                                                    </a>
                                                </div>
                                        @else
                                                <div class="" data-toggle="buttons" onclick="postId('{{ route('post.like', [$post->id, $post->reg_id]) }}')" >
                                                    <label class="btn btn-main">
                                                        <input type="radio" autocomplete="off" checked style="!important border-radius: 0px">
                                                        <i class="glyphicon glyphicon-thumbs-up"></i>
                                                    </label>
                                                    <label class="btn btn-main-active active">
                                                        <input type="radio" autocomplete="off" style="!important border-radius: 0px">
                                                        <i class="glyphicon glyphicon-thumbs-up">liked</i>
                                                    </label>
                                                    <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/alumni/post/'.$post->id) }}&display=popup','MyWindow',width=600,height=300); return false;">
                                                        <span class="glyphicon glyphicon-share-alt">share</span>
                                                    </a>
                                                </div>
                                        @endif
                                    </div>
                                @else
                                    <div align="center" style="margin: 30px; background: rgba(255,0,0,0.11); color: red">
                                        <h4>This post has been Reported!</h4>
                                        <a href="/alumni/post/{{ $post->id }}" target="_blank">Click here</a> to view post.
                                    </div>
                                @endif
                                <div id="snackbar"><h1 class="glyphicon glyphicon-thumbs-up"><i></i></h1></div>
                            </div>
                            <hr>
                        @endforeach
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <div class="col-md-3">
                <div class="card" style="position: fixed">
                    <div class="panel-heading">
                        <h3>
                            Directory List
                        </h3>
                    </div>
                    <div class="panel-body">

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
                        <div style="padding: 15px 62px ">
                            <a href="/alumni" class="btn-main">view more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('ss')
    <script type="text/javascript" src="{{ asset('js/jquery.jscroll.js') }}"></script>
    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                //loadingHtml: '<img class="center-block" src="{{ asset('storage/loading/loading.gif') }}" alt="Loading..." width="45px" height="45px" />',
                loadingHtml: '<div class="animationload"><div class="osahanloading"></div></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
    <div class="modal fade" id="post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel7">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel7">Share your Story</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'post-share' , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','id'=>'postform']) }}
                    {{ Form::token() }}
                    <div class="form-group" style="margin: 5px">
                        {{ Form::label('title', 'Title(Optional)', ['class' => 'control-label']) }}
                        {{ Form::text('title', '', [ 'class' => 'form-control']) }}
                    </div>
                    <div hidden>
                        {{ Form::text('url', 'alumni/home', [ 'class' => 'form-control']) }}
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
                        $("#postform").submit( function(e) {
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

    <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header panelcolor">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title fcolor" id="myModalLabel1">Report</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url'=> 'report-post' , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','id'=>'postform']) }}
                    {{ Form::token() }}

                    <div hidden>
                        <input name="postId" type="text" class="form-control" id="postid">
                    </div>


                    @foreach($report as $rep)
                        <input type="radio" name="report" value="{{ $rep->id }}" required> {{ $rep->type }}<br>
                        @endforeach

                    <div class="form-group" style="margin: 5px">
                        {{ Form::label('comment','Comment(optional)',['class' => 'control-label']) }}
                        {{ Form::textarea('comment', '', ['class' => 'form-control qwe']) }}
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn-sec">
                                <i class="glyphicon glyphicon-flag"></i>Report
                            </button>
                            <button type="button" class="btn-def" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

    <script>
        $('#report').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var postID = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-body #postid').val(postID)
        })
    </script>

    <script>
        function postId(name) {
            var dataString = 'Post Liked';
            $.ajax({
                type: "get",
                url: name,
                data: dataString,
                success: function() {
                    var x = document.getElementById("snackbar")
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                }
            });
            return false;
        }
    </script>

    @endsection
