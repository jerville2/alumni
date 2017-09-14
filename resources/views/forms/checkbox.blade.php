
<div class="row">
    <div class="col-md-12">
        <div id="check{{$item->id}}">
        @include('gen.questions')
            <!--start-->
            <table class="table">

                    @foreach($item->choices as $c)
                            @if(!strcasecmp($c->text,'others')==0)
                                @include('gen.checkboxes')
                            @else
                                @include('gen.others')
                            @endif

                    @endforeach
                    <tr style="display: none">
                        <td  style="display: none">

                                <div class="checkbox">
                                    @if($catf==1)
                                        {{Form::checkbox($item->id.'[]',-10, true,array('class'=>'sc'.$item->id)) }}fdaf
                                    @endif
                                </div>

                        </td>
                    </tr>

            </table>

            <!-- End of wrapper div-->
        </div>

    </div>
</div>



<script>
    if($( '{{ '#ot'.$item->id}}' ).is(':checked')){
        $( '{{ '#others'.$item->id}} ').show();
    }else
        $( '{{ '#others'.$item->id}} ').hide();
    $( '{{'#ot'.$item->id}}').click(function () {
        if($( '{{ '#ot'.$item->id}}' ).is(':checked')){
            $( '{{ '#others'.$item->id}} ').show();
        }else
            $( '{{ '#others'.$item->id}} ').hide();
    });
</script>



