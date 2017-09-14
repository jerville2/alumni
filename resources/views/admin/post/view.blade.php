@extends('admin.admin_panel')
@section('hs')
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    @endsection
@section('admin')
<div class="col-md-7 col-md-offset-2">
    <div class="card2">
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
            <hr>
            <h4 class="page-header">Report detail</h4>
            <dl class="dl-horizontal">
                <dt>Reported By</dt>
                <dd>{{ $user->alumni->firstname.' '.$user->alumni->middlename.' '.$user->alumni->surname }}</dd>
                <dt>Date Reported</dt>
                <dd>{{date('M d, Y  h:i:s a', strtotime($post->date_reported))}}</dd>
                <dt>Type</dt>
                <dd>{{ \Illuminate\Support\Facades\DB::table('post_report')->where('id', $post->report_id)->first()->type }}</dd>
                <dt>Message</dt>
                <dd>{{ $post->report_msg }}</dd>
            </dl>
            <hr>
            <div align="center">
                <h4>Action</h4><br>
                <a href="/admin/post/allow/{{ $post->id }}" class="btn-main">allow post</a>
                <a href="/admin/post/delete/{{ $post->id }}" class="btn-sec">delete post</a>
            </div>
        </div>

    </div>
</div>

    @endsection