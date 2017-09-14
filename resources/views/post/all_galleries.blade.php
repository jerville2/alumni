@extends('post.post')
@section('hs')
    <link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
    @endsection
@section('news')
    <div class="content">
        <div class="col-md-12">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>Alumni Gallery</strong></h3>
            </div>
            <hr>
            <div class="row">
                    <ul class="polaroids">
                        @foreach($galleries as $gallery)
                            <li class="col-lg-4 col-md-6 col-sm-6" style="margin-left: -50px; margin-right: 50px;">
                                <a href="/gallery/album/{{ $gallery->id }}" title="{{ $gallery->title }}">
                                    <div class="row">
                                        <ul class="polaroids" style="padding: 5px 30px">
                                        @foreach($gallery->images->take(3) as $image)
                                                <li class="col-xs-1">
                                                    <img alt="{{ $gallery->tile }}" src="{{ asset('storage'.$image->location)  }}" style="margin-left: -10px">
                                                </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
@endsection