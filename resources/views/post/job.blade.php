@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-10 col-md-offset-1">
            <h2><strong>{{ $job->title }}</strong></h2>
            <p>{{date('F d, Y', strtotime($job->date))}}</p>
            <hr>
            <p><strong>{{ $job->keywords }}</strong></p>
            <p class="text-justify"></p>
            {!! html_entity_decode($job->opportunity) !!}
            <hr class="featurette-divider">
        </div>
    </div>
@endsection