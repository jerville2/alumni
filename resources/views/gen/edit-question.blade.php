{{Form::open(array('url'=>route('item.update',$item->id),'method'=>'PUT'))}}
{{Form::hidden('item_id',$item->id)}}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{Form::label('Question')}}
            {{Form::text('desc',$item->desc,array('class'=>'form-control'))}}
        </div>

    </div>
</div>

