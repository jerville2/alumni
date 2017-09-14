<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Import Choices</div>

                <div class="panel-body">
                    @include('gen.messages')
                    {!! Form::open(array('url'=>route('migrateChoices.store'),'Method'=>'POST','files'=>true,'enctype'=>'multipart/form')) !!}
                        @include('gen.migrate-ci')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::submit('Import',array('class'=>'btn btn-success')) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('gen.loadItemsScript')
