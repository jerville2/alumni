
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#d{{$c->id}}">Delete</button>

<!-- Modal -->
<div id="d{{$c->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{$c->text}}</h4>
            </div>
            <div class="modal-body">
               <h3 class="text-danger">Are you sure you want to delete this it will remove everything that is connected to this choice</h3>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-8">
                        &nbsp;
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                    <div class="col-md-2">
                        {!! Form::open(array('url'=>route('choices.destroy',$c->id),'method'=>'Delete' )) !!}
                            {{Form::submit('Delete',array('class'=>'btn btn-md btn-warning'))}}
                        {!! Form::close() !!}
                    </div>

                </div>


            </div>
        </div>

    </div>
</div>