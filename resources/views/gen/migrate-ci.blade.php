<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{Form::label('Category')}}
            {{Form::select('cat',$cat->pluck('title','id'),null
                ,array(
                    'class'=>'form-control',
                    'id'=>'cat'
                ))
            }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group" id="items">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{Form::label('File')}}
            {{Form::file('file',array('class'=>'form-control'))}}
        </div>
    </div>
</div>

