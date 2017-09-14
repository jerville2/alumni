@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>Job Opportunities</strong></h3>
            </div>
            <hr>
            @foreach($jobs as $job)
                <div class="g">
                    <div class="rc">
                        <h4 class="r">
                            <a href="jobs/{{ $job->slug }}">
                                <strong>{{ strip_tags($job->title) }}</strong>
                            </a>
                        </h4>
                        <div class="s">
                                <span class="st">
                            <small>{{ date('F d, Y', strtotime($job->date)) }} </small> - {!! \Illuminate\Support\Str::words(strip_tags($job->opportunity), 20) !!}
                        </span>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $jobs->links() }}
        </div>
    </div>
@endsection