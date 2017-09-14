@php($galleries = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div style="margin-top: 100px"></div>
    <div class="container">
        {{ Form::open(['url'=> 'admin/galleries/publish' , 'method' => 'post', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal','role'=>'form']) }}
        {{ Form::token() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Album Name', ['class' => 'control-label']) }}
            {{ Form::text('title', '', [ 'class' => 'form-control']) }}
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}" style="margin: 5px">
            {{ Form::label('title', 'Description', ['class' => 'control-label']) }}
            {{ Form::text('desc', '', [ 'class' => 'form-control']) }}
            @if ($errors->has('desc'))
                <span class="help-block">
                    <strong>{{ $errors->first('desc') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('images.*') ? ' has-error' : '' }}" style="margin: 5px">
            <div align="center">
                <div class="fileUpload btn-def">
                    <span>upload images </span>
                    <input type="file" class="upload" id="images" name="images[]" onchange="preview_images();" multiple accept="image/png, image/jpeg, image/jpg"/>
                </div>
                @if ($errors->has('images.*'))
                    <span class="help-block">
                    <strong>{{ $errors->first('images.*') }}</strong>
                </span>
                @endif
            </div>
            <div class="row" id="image_preview" align="center" style="border: solid 2px; padding: 50px"></div>
        </div>

        <div class="form-group" style="margin: 5px">
            <input type="checkbox" value="1" name="pub">
            {{ Form::label('title', 'Published', ['class' => 'control-label']) }}
        </div>
        <div class="form-group" style="margin: 5px">
            <input type="checkbox" value="1" name="sys">
            {{ Form::label('title', 'System', ['class' => 'control-label']) }}
        </div>

        <div class="modal fade" id="progressDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 250px">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <strong>Saving Album...</strong>

                        <div class="progress progress-striped active">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div align="center" class="form-group" style="padding: 20px">
            <a href="{!! url('admin/galleries') !!}" class="btn-def">Cancel</a>
            <button class="btn-main" id="saveButton">save</button>
        </div>

        {{ Form::close() }}

        <hr>
    </div>

    <script type="text/javascript" src="http://www.expertphp.in/js/jquery.form.js"></script>
    <script>
        function preview_images()
        {
            var total_file=document.getElementById("images").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<div class='col-sm-2'><img class='img-rounded' width='100' height='100' style='margin-top: 25px; margin-bottom: 25px' ' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $("#saveButton").click(function() {
                var updateForm = document.querySelector('Form');
                var request = new XMLHttpRequest();

                $('#progressDialog').modal('show');
                request.upload.addEventListener('progress', function(e){
                    var percent = Math.round((e.loaded / e.total) * 100);
                    $('.progress-bar').width(percent+'%');
                    $('.sr-only').html(percent+'%');
                }, false);

                request.addEventListener('load', function(e){
                    var jsonResponse = JSON.parse(e.target.responseText);
                    if(jsonResponse.errors) {
                        console.log(jsonResponse.errors);
                    }
                    else {
                        $('#progressDialog').modal('hide');
                    }
                }, false);

                updateForm.addEventListener('submit', function(e){
                    e.preventDefault();
                    var formData = new FormData(updateForm);
                    request.open('post',updateForm['action']);
                    request.send(formData);
                }, false);
            })
        });
    </script>
@endsection