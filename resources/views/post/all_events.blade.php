@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>Events and Activities</strong></h3>
            </div>
            <hr>
            @foreach($events as $event)
                <div class="g">
                    <div class="rc">
                        <h4 class="r">
                            <a href="{{ $event->type }}/{{ $event->slug }}">
                                <strong>{{ strip_tags($event->title) }}</strong>
                            </a>
                        </h4>
                        <div class="s">
                                <span class="st">
                            <small>{{ date('F d, Y', strtotime($event->date)) }} </small> - {!! \Illuminate\Support\Str::words(strip_tags($event->event), 20) !!}
                        </span>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $events->links() }}
        </div>
    </div>
    @endsection