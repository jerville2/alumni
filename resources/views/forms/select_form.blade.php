<div id="textSelect{{$item->id}}">
        <div class="row" >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="card-title">@include('gen.questions')</div>
                        @if($catf==1)
                            @if($item->answers($id)->count())
                                {{Form::select($item->id,array(null =>'---------')+$item->choices->pluck('text','id')->toArray(),$item->answers($id)->first()->choice_id,
                                array('class'=>'form-control','id'=>$item->id))}}
                            @else
                                {{Form::select($item->id,array(null=>'---------')+$item->choices->pluck('text','id')->toArray(),null
                                    ,array('class'=>'form-control','id'=>$item->id,'placeholder'=>'----------------------'))}}
                            @endif
                        @else
                            {{Form::select($item->id,array(null =>'---------')+$item->choices->pluck('text','id')->toArray(),null
                            ,array('class'=>'form-control','id'=>$item->id,'placeholder'=>'----------------------'))}}

                            <div class="row">
                                <div class="col-md-12">
                                    <button id="load" class="btn btn-info btn-xs"> Load Choices for Item {{$item->desc}}</button>
                                </div>
                            </div>
                            <br>
                            <div id="list" class="" style="display: none">
                                @include('forms.list-select')
                            </div>

                        @endif
                    </div>


                </div>
            </div>
        </div>

    @include('gen.disabled')

</div>
<script>
    $('#load').click(function () {
        $('#list').slideToggle();
    });
</script>
