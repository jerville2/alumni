@extends('homecoming.homecoming')

@section('reun')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <h2><strong>{{ $reu->title }}</strong></h2>
            <p>{{date('F d, Y', strtotime($reu->reundate))}}</p>
            <a class="btn-def" href="" onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ url('/reunions/'.$reu->slug) }}&display=popup','MyWindow',width=600,height=300); return false;">
                <span class="glyphicon glyphicon-share-alt">share</span>
            </a>
            <hr>
            <p><strong>{{ $reu->desc }}</strong></p>
            <p class="text-justify"></p>
            {!! html_entity_decode($reu->description) !!}
            <hr class="featurette-divider">
        </div>
    </div>
@endsection