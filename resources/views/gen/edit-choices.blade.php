{{Form::open(array('url'=>route('choices.update',$c->id),'method'=>'PUT'))}}
    {{Form::hidden('item_id',$item->id)}}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::text('text',$c->text,array('class'=>'form-control'))}}
            </div>

        </div>
    </div>

