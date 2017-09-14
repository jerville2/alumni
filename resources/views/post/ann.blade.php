@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-10 col-md-offset-1">
            <h2><strong>{{ $ann->title }}</strong></h2>
            <p>{{date('F d, Y', strtotime($ann->date))}}</p>
            <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/announcements/'.$ann->slug) }}&display=popup','MyWindow',width=600,height=300); return false;">
                <span class="glyphicon glyphicon-share-alt">share</span>
            </a>
            <hr>
            <p><strong>{{ $ann->desc }}</strong></p>
            <p class="text-justify"></p>
            {!! html_entity_decode($ann->announcement) !!}
            <hr class="featurette-divider">
        </div>
    </div>
    @endsection
