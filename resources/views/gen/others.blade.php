<tr>
    <td>
        <div class="col-md-4">
            <div class="checkbox">
               @if(Route::currentRouteName()!='category.show')
                   @php($idff=$id)
                @endif
                @php($id=$c->id?$c->id:-10)

                @if(Route::currentRouteName()!='category.show')

                    @if($item->answers_others($idff)->count())
                        <label> {{Form::checkbox($item->id.'[]',$id,
                                                    $item->answers_others($idff)->count()?true:false,array('id'=>'ot'.$item->id,'class'=>'sc'.$item->id) ) }}
                            Others
                        </label>
                    @else
                        <label> {{Form::checkbox($item->id.'[]',$id ,false,array('id'=>'ot'.$item->id,'class'=>'sc'.$item->id)) }} Others</label>
                    @endif
                @else
                    <label> {{Form::checkbox($item->id.'[]',$id, false,array('id'=>'ot'.$item->id,'class'=>'sc'.$item->id)) }}Others</label>
                @endif
            </div>
        </div>
        <div class="col-md-8" id="{{'others'.$item->id}}" style="display: none">
                @if($catf==1)
                    @if($item->answers_others($idff)->count() )
                        {!! Form::text('others'.$item->id,$item->answers_others($idff)->first()->others,array('class'=>'form-control')) !!}
                    @else
                        {!! Form::text('others'.$item->id,null,array('class'=>'form-control')) !!}
                    @endif
                @else
                    {!! Form::text('others'.$item->id,null,array('class'=>'form-control')) !!}
                @endif
        </div>
    </td>
</tr>