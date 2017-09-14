{{Form::label('Item')}}
{{Form::select('item',$items->pluck('desc','id'),null
    ,array(
        'class'=>'form-control',
    ))
}}