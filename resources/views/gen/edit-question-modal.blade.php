
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editQuestion{{$item->id}}">Edit Question</button>

<!-- Modal -->
<div id="editQuestion{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{$item->desc}}</h4>
            </div>
            <div class="modal-body">
               @include('gen.edit-question')
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-8">&nbsp;</div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-2">

                        @include('gen.end-form')
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>