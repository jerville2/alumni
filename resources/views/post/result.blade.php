@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel-heading panelcolor" style="margin-top: 10px">
                <h3 class="fcolor"><strong>Results</strong></h3>
            </div>
            <hr>

            @if($results->count() == 0)
                No Result found
            @else
            @foreach($results as $result)
            <div class="g">
                <div class="rc">
                    <h4 class="r">
                        <a href="{{ $result->type }}/{{ $result->slug }}">
                            <strong>{{ strip_tags($result->headline) }}</strong>
                        </a>
                    </h4>
                    <div class="s">
                        <div class="kv">
                            Category: {{ strtoupper($result->type) }}
                        </div>
                        <span class="st">
                            <small>{{ date('F d, Y', strtotime($result->date)) }} </small> - {!! \Illuminate\Support\Str::words(strip_tags($result->news), 20) !!}
                        </span>

                    </div>
                </div>
            </div>
            @endforeach
            @endif
            {{ $results->links() }}
        </div>
    </div>
@endsection
