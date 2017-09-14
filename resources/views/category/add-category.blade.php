<div class="panel panel-info">
    <div class="panel-heading"><h4>New Category</h4></div>
    <div class="panel-body">
        {{Form::open(array('url'=>route('category.store'),'method'=>'POST'))}}
        <div class="form-group">
            {{Form::label('Title')}}
            {{Form::text('title',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('Published')}}
            {{Form::select('published',['Unpublished','Published'],null,array('class'=>'form-control'))}}
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-8">
                {{Form::submit('Add',array('class'=>'btn btn-success'))}}
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>