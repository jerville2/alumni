<div class="row">
    <div class="col-md-12">
        <div id="options{{$item->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title">@include('gen.questions')</div>
                        </div>
                        <ul class="list-group-flush">
                            @if($catf==1)

                                @foreach($item->choices as $c)

                                    <li class="list-group-item">
                                        <div class="checkbox">
                                            <label>
                                                @if($item->answers($id)->count())
                                                    @if($item->answers($id)->first()->choice_id==$c->id)
                                                        {!! Form::radio($item->id,$c->id,true,array('class'=>'dis'.$item->id,'id'=>'c'.$c->id)) !!}
                                                    @else
                                                        {!! Form::radio($item->id,$c->id,false,array('class'=>'dis'.$item->id,'id'=>'c'.$c->id)) !!}
                                                    @endif
                                                @else
                                                    {!! Form::radio($item->id,$c->id,false,array('class'=>'dis'.$item->id,'id'=>'c'.$c->id)) !!}
                                                @endif
                                                {{$c->text}}
                                            </label>
                                        </div>
                                    </li>

                                @endforeach

                            @else

                                @foreach($item->choices as $c)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label> {!! Form::radio($item->id,$c->id,false,array('class'=>'dis'.$item->id,'id'=>'c'.$c->id)) !!}  {{$c->text}} </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @include('gen.delete-modal')

                                        </div>
                                        <div class="col-md-2">
                                            @include('gen.edit-modal')

                                        </div>

                                    </div>
                                @endforeach

                            @endif
                        </ul>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>

@include('gen.disabledc')