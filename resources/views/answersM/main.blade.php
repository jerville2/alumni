<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Import Answers</div>
                <div class="panel-body">
                    @include('gen.messages')
                    {!! Form::open(array('url'=>route('answersM.store'),'Method'=>'POST','files'=>true,'enctype'=>'multipart/form')) !!}
                       @include('gen.migrate-ci')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Import',array('class'=>'btn btn-success'
                                    ,'id'=>'submit') ) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <br>

                </div><!-- end of panel body-->
            </div>
        </div>
    </div>
</div>
@include('gen.loadItemsScript')

