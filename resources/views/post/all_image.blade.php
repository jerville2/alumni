@extends('post.post')
@section('hs')
<link href="{{asset('css/ekko-lightbox.css')}}" rel="stylesheet">
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
            width: 180px;
            height: 120px;
            margin-right: 5px;
            margin-bottom: 10px;
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
    </style>
    @endsection
@section('fs')
    <script src="{{ asset('js/ekko-lightbox.js') }}"></script>
    @endsection
@section('news')
    <div class="content">
        <div class="col-md-11">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>{{ $images->title }} Album</strong></h3>
            </div>
            <hr>
            <div class="photos">
                @foreach($images->images as $image)
                <div class="photo-item" align="center">
                        <a href="{{ asset('storage'.$image->location) }}" data-toggle="lightbox" data-gallery="example-gallery">
                            <img class="img-responsive" src="{{ asset('storage'.$image->location) }}">
                        </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection