{!! Form::open(array('url'=>route('report.store'),'method'=>'POST' ) ) !!}
<div class="row">
    <div  class="col-md-2" >
        <div class="form-group">
            <center>{!! Form::label('From') !!} </center>
            {!! Form::select('yg',array_reverse($yg->pluck('year_graduated','year_graduated')->toArray()),null,array('class'=>'form-control',
                'id'=>'from' )) !!}
        </div>
    </div>

    <div  class="col-md-3">
        <div class="form-group">
            <center>{!! Form::label('College') !!}</center>
            {!! Form::select('college', $college->pluck('college','college_code')->toArray(),null
                    ,array('class'=>'form-control',
                 )) !!}
        </div>
    </div>

    <div  class="col-md-3">
        <div class="form-group">
            <center>{!! Form::label("Items") !!}</center>
            {!! Form::select('items',$items->pluck('desc','id')->toArray(),$item?$item->id:null
            ,array('class'=>'form-control','id'=>'item')) !!}
        </div>
    </div>

    <div  class="col-md-1">
            <br>
            {!! Form::submit('Generate',array('class'=>'btn btn-primary btn-lg')) !!}
    </div>

</div>
{!! Form::close() !!}