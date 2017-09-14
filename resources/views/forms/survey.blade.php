<div id="survey{{$item->id}}">
    @include('gen.questions')
    @if($item->choices()->count())
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr>

                    <td width="60">&nbsp;</td>
                    @for($i=1;$i<=$item->op_val;$i++)
                        <td width="5%">{{$i}}</td>
                    @endfor
                    @if($catf!=1)
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    @endif
                </tr>
                @foreach($item->choices as $c)
                        <tr>
                            <td width="60">{{$loop->index+1}}. {{$c->text}} </td>
                            @for($i=1;$i<=$item->op_val;$i++)
                             @if($catf==1)
                                 @if($item->answers_type34($id,$c->id)->count())
                                      <td>{!! Form::radio($item->id.'-'.$c->id, $i,
                                          $item->answers_type34($id,$c->id)->first()->ans_rate==$i?true:false
                                            ,array('required','class'=>'sv'.$item->id) )!!}
                                      </td>
                                 @else
                                        <td>{!! Form::radio($item->id.'-'.$c->id, $i,
                                              false
                                            ,array('required','class'=>'sv'.$item->id) )!!}
                                        </td>
                                 @endif

                             @else
                                    <td>{!! Form::radio($item->id.'-'.$c->id, $i,
                                         false,array('required','class'=>'sv'.$item->id) )!!}
                                    </td>
                             @endif
                            @endfor
                            @if($catf!=1)
                                <td width="10%">@include('gen.delete-modal')</td>
                                <td width="10%">@include('gen.edit-modal')</td>
                            @endif
                        </tr>
               @endforeach

            </table>
        </div>
    </div>
    @endif
</div>