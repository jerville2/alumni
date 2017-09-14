@extends('post.post')

@section('news')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>Announcements</strong></h3>
            </div>
            <hr>
            @foreach($anns as $ann)
                <div class="g">
                    <div class="rc">
                        <h4 class="r">
                            <a href="{{ $ann->type }}/{{ $ann->slug }}">
                                <strong>{{ strip_tags($ann->title) }}</strong>
                            </a>
                        </h4>
                        <div class="s">
                                <span class="st">
                            <small>{{ date('F d, Y', strtotime($ann->date)) }} </small> - {!! \Illuminate\Support\Str::words(strip_tags($ann->announcement), 20) !!}
                        </span>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $anns->links() }}
        </div>
    </div>
@endsection