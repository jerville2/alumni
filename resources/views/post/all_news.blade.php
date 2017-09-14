@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>News Features</strong></h3>
            </div>
            <hr>
                @foreach($allNews as $new)
                    <div class="g">
                        <div class="rc">
                            <h4 class="r">
                                <a href="{{ $new->type }}/{{ $new->slug }}">
                                    <strong>{{ strip_tags($new->headline) }}</strong>
                                </a>
                            </h4>
                            <div class="s">
                                <span class="st">
                            <small>{{ date('F d, Y', strtotime($new->date)) }} </small> - {!! \Illuminate\Support\Str::words(strip_tags($new->news), 20) !!}
                        </span>

                            </div>
                        </div>
                    </div>
                @endforeach
            {{ $allNews->links() }}
        </div>
    </div>
@endsection