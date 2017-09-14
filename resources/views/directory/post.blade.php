@extends('directory.directory')
@section('directory')
    <div class="col-md-6 col-md-offset-3">
        <div class="card2">
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                    <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                </span>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Report</a></li>
                </ul>
            </div>
            <div class="panel-heading">
                <a href="/alumni/view/{{ $post->user->id }}">
                    <img class="img-circle pull-left" src="{{ asset('storage'.$post->user->picture->location) }}" width="50px" height="50px" />
                    <h3>{{ $post->user->alumni->firstname.' '.$post->user->alumni->middlename.' '.$post->user->alumni->surname }}</h3>
                </a>
                <h5><span>Shared</span> - <span>{{ date('M d, Y  h:i:s a', strtotime($post->date)) }}</span> </h5>
            </div>
            <div class="panel-body" style="top: 5px">
                <h2><strong>{{ $post->title }}</strong></h2>
                {!! $post->post !!}
            </div>
            <div class="panel-footer">
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
                        <a class="btn-main-active" href="{{ route('post.like', [$post->id, $post->reg_id]) }}">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                        </a>
                    @else
                        <a class="btn-main" href="{{ route('post.like', [$post->id, $post->reg_id]) }}">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                        </a>
                    @endif
                    <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/alumni/post/'.$post->id) }}&display=popup','MyWindow',width=600,height=300); return false;">
                        <span class="glyphicon glyphicon-share-alt">share</span>
                    </a>
            </div>
        </div>
    </div>
    @endsection