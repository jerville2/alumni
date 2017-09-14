@php($o = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="page-header">
            <h2>Job Opportunities</h2>
        </div>
        {{ Form::open(['url'=> 'admin/opportunities/update/'.$opp->id , 'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
            {{ Form::text('title', $opp->title, [ 'class' => 'form-control', 'required']) }}
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
            {{ Form::text('slug', $opp->slug, [ 'class' => 'form-control', 'id' => 'result', 'required']) }}
        </div>
        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'SEO Keywords', ['class' => 'control-label']) }}
            {{ Form::text('keywords', $opp->keywords, [ 'class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'SEO Description', ['class' => 'control-label']) }}
            {{ Form::text('desc', $opp->desc, [ 'class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'SEO Description', ['class' => 'control-label']) }}
            <textarea name="contents" id="ckeditor" class="ckeditor" cols="30" rows="25">{{ $opp->opportunity }}</textarea>
            <script type="text/javascript">
                CKEDITOR.replace( 'ckeditor' );
            </script>
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox"  value="1" name="pub" id="pubd">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
            @if($opp->published == 1)
            <script>$('#pubd').prop('checked', true);</script>
                @endif
        </div>
        <div class="form-group" style="margin: 5px">
            {{ Form::label('title', 'Publish Date', ['class' => 'control-label']) }}
            {{Form::text('pubDate', date('M d, Y', strtotime($opp->date)), ['class' => 'datepicker form-control', 'required'])}}
            <script type="text/javascript">
                $('.datepicker').datepicker({
                    format: 'M d, yyyy'
                });
            </script>
        </div>

        <div align="center" class="form-group">
            <a href="{!! url('admin/opportunities') !!}" class="btn-def">Cancel</a>
            <button class="btn-main">save</button>
        </div>

        {{ Form::close() }}
    </div>
@endsection