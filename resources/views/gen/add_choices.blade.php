{{Form::open(array('url'=>route('choices.store'),'method'=>'POST'))}}
    {{Form::hidden('item_id',$item->id)}}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('Text')}}
                {{Form::text('text',null,array('class'=>'form-control'))}}
            </div>

        </div>
    </div>
