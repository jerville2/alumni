<div class="row">
    <div class="col-md-12">
        <div id="textSelect{{$item->id}}">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title">@include('gen.questions')</div>
                            @if($catf==1)
                                @if($item->answers($id)->count())
                                    {!! Form::textarea($item->id,$item->answers($id)->first()->ans
                                    ,array('class'=>'form-control','id'=>$item->id)) !!}
                                @else
                                    {!! Form::textarea($item->id,null,array('class'=>'form-control','id'=>$item->id)) !!}
                                @endif
                                @else
                                    {!! Form::textarea($item->id,null,array('class'=>'form-control','id'=>$item->id)) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



