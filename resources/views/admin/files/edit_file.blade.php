@php($f = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header">
            <h2>Downloadable Files</h2>
        </div>
        {{ Form::open(['url'=> 'admin/files/update/'.$file->dl_code , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Filename', ['class' => 'control-label']) }}
            {{ Form::text('title', $file->title, [ 'class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox"  value="1" name="pub" id="pubd">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
            @if($file->published == 1)
                <script>$('#pubd').prop('checked', true);</script>
            @endif
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Publish Date', ['class' => 'control-label']) }}
            {{Form::text('pubDate', date('M d, Y', strtotime($file->dldate)), ['class' => 'datepicker form-control'])}}
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