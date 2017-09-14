


<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#dI{{$item->id}}">Delete</button>

<!-- Modal -->
<div id="dI{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Choices for {{$item->desc}}</h4>
            </div>
            <div class="modal-body">
                <h2 class="text-danger">Are you sure you want to delete this item.</h2>
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
                        @include('gen.delete-item')
                    </div>

                </div>


            </div>
        </div>

    </div>
</div>