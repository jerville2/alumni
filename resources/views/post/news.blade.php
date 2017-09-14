@extends('post.post')
@section('sss')
    @endsection
@section('news')
    <div class="content">
        <div class="col-md-10 col-md-offset-1">
            <h2><strong>{{ $news->headline }}</strong></h2>
            <p>{{date('F d, Y', strtotime($news->date))}}</p>
            <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/news/'.$news->slug) }}&display=popup','MyWindow',width=600,height=300); return false;">
                <span class="glyphicon glyphicon-share-alt">share</span>
            </a>
            <hr>
            <p><strong>{{ $news->keywords }}</strong></p>
            <p class="text-justify"></p>
            {!! html_entity_decode($news->news) !!}
            <hr class="featurette-divider">
        </div>
    </div>
@endsection