@php($galleries = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div style="margin-top: 100px"></div>
    <div class="container">
        {{ Form::open(['url'=> 'admin/galleries/update/'.$album->id , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Album Name', ['class' => 'control-label']) }}
            {{ Form::text('title', $album->title, [ 'class' => 'form-control']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Description', ['class' => 'control-label']) }}
            {{ Form::text('desc', $album->desc, [ 'class' => 'form-control']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox" value="1" name="pub" id="pubd">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
            @if($album->published == 1)
                <script>$('#pubd').prop('checked', true);</script>
            @endif
        </div>
        <div class="form-group" style="margin: 5px">
            <input type="checkbox" value="1" name="sys" id="syst">
            {{ Form::label('title', 'System', ['class' => 'control-label']) }}
            @if($album->system == 1)
                <script>$('#syst').prop('checked', true);</script>
                @endif
        </div>

        <div align="center" class="form-group" style="padding: 20px">
            <a href="{!! url('admin/galleries') !!}" class="btn-def">Cancel</a>
            <button class="btn-main">save</button>
        </div>

        {{ Form::close() }}

        <hr>
    </div>
@endsection