@php($n = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header">
            <h2>News</h2>
        </div>
        {{ Form::open(['url'=> 'admin/news/update/'.$news->id , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
            {{ Form::text('title', $news->headline, [ 'class' => 'form-control', 'required']) }}

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
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
            {{ Form::text('slug', $news->slug , [ 'class' => 'form-control', 'id' => 'result', 'required']) }}
        </div>

        <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'SEO Keywords', ['class' => 'control-label']) }}
            {{ Form::text('keywords', $news->keywords, [ 'class' => 'form-control', 'required']) }}
            @if ($errors->has('keywords'))
                <span class="help-block">
                    <strong>{{ $errors->first('keywords') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'SEO Description', ['class' => 'control-label']) }}
            {{ Form::text('desc', $news->desc, [ 'class' => 'form-control', 'required']) }}
            @if ($errors->has('desc'))
                <span class="help-block">
                    <strong>{{ $errors->first('desc') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Content', ['class' => 'control-label']) }}
            <textarea name="contents" id="ckeditor" class="ckeditor" cols="30" rows="25">{{ $news->news }}</textarea>
            <script type="text/javascript">
                CKEDITOR.replace( 'ckeditor' );
            </script>
            @if ($errors->has('contents'))
                <span class="help-block">
                    <strong>{{ $errors->first('contents') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox"  value="1" name="pub" id="pubd">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
            @if($news->published == 1)
            <script>$('#pubd').prop('checked', true);</script>
                @endif
        </div>

        <div class="form-group{{ $errors->has('pubDate') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Publish Date', ['class' => 'control-label']) }}
            {{Form::text('pubDate', date('M d, Y', strtotime($news->date)), ['class' => 'datepicker form-control', 'required'])}}
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

        <div align="center" class="form-group">
            <a href="{!! url('admin/news') !!}" class="btn-def">Cancel</a>
            <button class="btn-main">save</button>
        </div>

        {{ Form::close() }}
    </div>
@endsection