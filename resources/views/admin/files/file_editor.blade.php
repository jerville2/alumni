@php($f = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header">
            <h2>Downloadable Files</h2>
        </div>
        {{ Form::open(['url'=> 'admin/files/publish' , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Upload', ['class' => 'control-label']) }}
            {{ Form::file('file') }}
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Filename', ['class' => 'control-label']) }}
            {{ Form::text('title', '', [ 'class' => 'form-control']) }}
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox" value="1" name="pub">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
        </div>

        <div class="form-group{{ $errors->has('pubDate') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Publish Date', ['class' => 'control-label']) }}
            {{Form::text('pubDate', \Carbon\Carbon::now()->format('M d, Y'), ['class' => 'datepicker form-control', 'required'])}}
            @if ($errors->has('pubDate'))
                <span class="help-block">
                    <strong>{{ $errors->first('pubDate') }}</strong>
                </span>
            @endif
            <script type="text/javascript">
                $('.datepicker').datepicker({
                    format: 'M d, yyyy'
                });
            </script>
        </div>

        <div align="center" class="form-group" style="padding: 20px">
            <a href="{!! url('admin/files') !!}" class="btn-def">Cancel</a>
            <button class="btn-main">save</button>
        </div>

        {{ Form::close() }}

        <hr>
    </div>

    <script>
        Dropzone.autoDiscover = false;

        // Dropzone class:
        var myDropzone = new Dropzone("div#mydropzone", { url: "/file/post"});

        // If you use jQuery, you can use the jQuery plugin Dropzone ships with:
        $("div#myDrop").dropzone({ url: "/file/post" });
    </script>
@endsection