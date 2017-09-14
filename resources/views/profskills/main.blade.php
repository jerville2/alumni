<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Import Prof Skills</div>
                <div class="panel-body">
                    @include('gen.messages')
                    {!! Form::open(array('url'=>route('profSkillsM.store'),'Method'=>'POST','files'=>true,'enctype'=>'multipart/form')) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('File')}}
                                    {{Form::file('file',array('class'=>'form-control'))}}
                                </div>
                            </div>
                        </div>
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