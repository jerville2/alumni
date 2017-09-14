<tr>
    <div class="checkbox" >
        @if($catf==1)
            @if($item->answers_type34($id,$c->id)->count())
                <label> {{Form::checkbox($item->id.'[]',$c->id,
                                            $item->answers_type34($id,$c->id)->first()->choice_id==$c->id?true:false )
                                            ,array('class'=>'sc'.$item->id)}}
                    {{$c->text}}
                </label>
            @else
                <label> {{Form::checkbox($item->id.'[]',$c->id, false,array('class'=>'sc'.$item->id)) }}{{$c->text}}</label>
            @endif
        @else
            <div class="row">
                <div class="col-md-9">
                    <label >
                        {{Form::checkbox($item->id.'[]',$c->id, false,array('class'=>'sc'.$item->id)) }}{{$c->text}}

                    </label>

                </div>
                <div class="col-md-3">
                    @include('gen.delete-modal')
                    @include('gen.edit-modal')
                </div>
            </div>

        @endif

    </div>
</tr>