@php($galleries = 'active')
@extends('admin.admin_panel')
@section('hs')
<style>
    div.photo-item:hover {
        -webkit-transform:scale(1.25);
        -moz-transform:scale(1.25);
        -webkit-box-shadow:0 3px 6px rgba(0,0,0,.5);
        -moz-box-shadow:0 3px 6px rgba(0,0,0,.5);
        position:relative;
        z-index:5;
    }
    .photos{
        padding-bottom: 30px;
        clear: both;
    }
    div.photo-item {
        border: solid 1px;
        width: 250px;
        height: 180px;
        margin-right: 50px;
        margin-bottom: 100px;
    }
    .photo-item {
        float: left;
        margin-bottom: 1px;
        position: relative;
    }

    .photo-item img {
        display: block;
        height: 100%;
    }
    a img {
        border: 0;
    }
    img {
        max-width: 100%;
    }
    div.desc {
        background: #ffffdf;
        padding: 15px;
        text-align: center;
        border: solid 1px;
    }
</style>
@endsection
@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $albums->title }}</h2>
            </div>
            <div class="col-md-6">
                <div align="right" style="margin: 15px">
                    <a href="{{$albums->id}}/upload" class="btn-main">Add new</a>
                </div>
            </div>
        </div>
        <hr>

        <div class="col-md-10 col-md-offset-1">
            <div class="photos">
                @foreach($albums->images as $album)
                    <div class="photo-item" align="center">
                        <a href="{{ asset('storage'.$album->location) }}" data-toggle="lightbox" data-gallery="example-gallery">
                            <img class="img-responsive" src="{{ asset('storage'.$album->location) }}" alt="{{ $album->title }}">
                        </a>
                        <div class="desc">
                            <div class="row">
                                <p hidden id="{{ $album->id }}">{{ asset('storage'.$album->location) }}</p>
                                <button class="btn-edit" id="a{{$album->id}}" onclick="copyToClipboard('{{ '#'.$album->id }}')"><i class="glyphicon glyphicon-copy"></i> Copy url</button>
                                <script>
                                    function copyToClipboard(element) {
                                        var $temp = $("<input>");
                                        $("body").append($temp);
                                        $temp.val($(element).text()).select();
                                        document.execCommand("copy");
                                        $temp.remove();
                                    }

                                    $(document).ready(function(){
                                        $('#a{{$album->id}}').click(function(){
                                            swal({
                                                title: "Url Copied",
                                                text: "{{ asset('storage'.$album->location) }}",
                                                type: "success"
                                            });
                                        })
                                    });
                                </script>
                                <a id="delete{{$album->id}}" class="btn-del"><i class="glyphicon glyphicon-trash"></i> delete</a>
                                <script>
                                    $(document).ready(function(){
                                        $('#delete{{$album->id}}').click(function(){
                                            swal({
                                                    title: "Delete Image?",
                                                    text: "Are you Sure You want to delete {{$album->title}}!",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonColor: "Green",
                                                    confirmButtonText: "Yes"
                                                },
                                                function(){
                                                    window.location.href = 'image/delete/{{$albums->id}}/{{$album->id }}';
                                                });
                                        })
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
    </div>

@endsection