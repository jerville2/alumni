@php($r = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header">
            <h2>Reunions</h2>
        </div>
        {{ Form::open(['url'=> 'admin/reunions/update/'.$reu->reun_code , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
            {{ Form::text('title', $reu->title, [ 'class' => 'form-control', 'required']) }}
            <script>
                function convertToSlug(Text)
                {
                    return Text
                        .toLowerCase()
                        .replace(/ /g,'-')
                        .replace(/[^\w-]+/g,'');
                }

                $("#title").keyup(function(){
                    var Text = convertToSlug($(this).val());
                    $("#result").val(Text);
                });
            </script>
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Url', ['class' => 'control-label']) }}
            {{ Form::text('slug', $reu->slug, [ 'class' => 'form-control', 'id' => 'result', 'required']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'SEO Keywords', ['class' => 'control-label']) }}
            {{ Form::text('keywords', $reu->keywords, [ 'class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'SEO Description', ['class' => 'control-label']) }}
            {{ Form::text('desc', $reu->desc, [ 'class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Content', ['class' => 'control-label']) }}
            <textarea name="contents" id="ckeditor" class="ckeditor" cols="30" rows="25">{{ $reu->description }}</textarea>
            <script type="text/javascript">
                CKEDITOR.replace( 'ckeditor' );
            </script>
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox"  value="1" name="pub" id="pubd">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
            @if($reu->published == 1)
            <script>$('#pubd').prop('checked', true);</script>
                @endif
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Publish Date', ['class' => 'control-label']) }}
            {{Form::text('pubDate', date('M d, Y', strtotime($reu->reundate)), ['class' => 'datepicker form-control', 'required'])}}
            <script type="text/javascript">
                $('.datepicker').datepicker({
                    format: 'M d, yyyy'
                });
            </script>
        </div>

        <div align="center" class="form-group">
            <a href="{!! url('admin/reunions') !!}" class="btn-def">Cancel</a>
            <button class="btn-main">save</button>
        </div>

        {{ Form::close() }}
    </div>
@endsection