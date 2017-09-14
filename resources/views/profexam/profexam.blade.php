
<div class="row">
    <div class="col-md-12">
        <p> Professional Exams</p>
        <table class="table table-responsive table-condensed">
            <thead>
            <td align="center">Exam</td>
            <td align="center">Date</td>
            <td align="center">Rating</td>
            <td align="center">Honor</td>
            <td align="center">&nbsp;</td>
            </thead>
            <tbody>
            @foreach($educ as $ed)
                <tr>
                    <td align="center">{{$ed->col->collegeabbr}}</td>
                    <td align="center">{{$ed->deg->degree}}</td>
                    <td align="center">{{$ed->ay_d?$ed->ay_d->Description:''}}</td>
                </tr>
            @endforeach
            <tr>
                {!! Form::open(array('url'=>route('educ-save'),'method'=>'POST')) !!}
                {!! Form::hidden('a_id',$id) !!}
                <td>{!! Form::select('exam',$exams->pluck('Description','ID')->toArray(),null,array('class'=>'form-control','id'=>'college','placeholder'=>'-------') ) !!}</td>
                <td>{!! Form::text('date',null,array('class'=>'form-control') ) !!}</td>
                <td>{!! Form::text('rating',null,array('class'=>'form-control') ) !!}</td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
            </tbody>
        </table>
    </div>
</div>

