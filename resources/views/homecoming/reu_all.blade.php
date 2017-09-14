@extends('homecoming.homecoming')

@section('reun')
    <div class="content">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel-heading panelcolor" style="margin-top: 10px;">
                <h3 class="fcolor"><strong>Upcoming Reunions</strong></h3>
            </div>
            <hr>
            @foreach($reus as $reu)
                <div class="g">
                    <div class="rc">
                        <h4 class="r">
                            <a href="reunion/{{ $reu->slug }}">
                                <strong>{{ strip_tags($reu->title) }}</strong>
                            </a>
                        </h4>
                        <div class="s">
                                <span class="st">
                            <small>{{ date('F d, Y', strtotime($reu->reundate)) }} </small> - {!! \Illuminate\Support\Str::words(strip_tags($reu->description), 20) !!}
                        </span>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $reus->links() }}
        </div>
    </div>
@endsection