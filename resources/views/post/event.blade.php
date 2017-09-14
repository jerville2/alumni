@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-10 col-md-offset-1">
            <h2><strong>{{ $event->title }}</strong></h2>
            <p>{{date('F d, Y', strtotime($event->date))}}</p>
            <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/events/'.$event->slug) }}&display=popup','MyWindow',width=600,height=300); return false;">
                <span class="glyphicon glyphicon-share-alt">share</span>
            </a>
            <hr>
            <p><strong>{{ $event->keywords }}</strong></p>
            <p class="text-justify">
                {!! html_entity_decode($event->event) !!}
            </p>
            <hr class="featurette-divider">
        </div>
    </div>
    @endsection