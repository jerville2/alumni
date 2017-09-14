@php($s = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header">
            <h2>Edit Image</h2>
        </div>
        {{ Form::open(['url'=> 'admin/slides/update/'.$slide->id , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group" style="margin: 5px">
            <div align="center">
                <img src="{{asset('storage'.$slide->location)}}" class="img-thumbnail" width="500px">
            </div>
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
            {{ Form::text('title', $slide->title, [ 'class' => 'form-control']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Description', ['class' => 'control-label']) }}
            {{ Form::text('slug', $slide->description, [ 'class' => 'form-control', 'id' => 'result']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox"  value="1" name="pub" id="pubd">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
            @if($slide->published == 1)
                <script>$('#pubd').prop('checked', true);</script>
            @endif
        </div>

        <div align="center" class="form-group">
            <a href="{!! url('admin/slides') !!}" class="btn-def">Cancel</a>
            <button class="btn-main">save</button>
        </div>

        {{ Form::close() }}
    </div>
@endsection