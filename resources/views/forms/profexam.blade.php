
<div class="row">
    <div class="col-md-12">
        <p> Professional Exams</p>
        <table class="table table-responsive table-condensed">
            <thead>
            <td align="center">Exam</td>
            <td align="center">Date</td>
            <td align="center">Rating</td>
            <td align="center">&nbsp;</td>
            </thead>
            <tbody id="prof_con">


            </tbody>
            <tr>
                {!! Form::open(array('url'=>route('exam-save'),'method'=>'POST','id'=>'exam_form')) !!}
                {!! Form::hidden('a_id',$id,array('id'=>'e_id')) !!}
                <td>{!! Form::select('exam',$exams->pluck('Description','ID')->toArray(),null,array('class'=>'form-control','id'=>'college') ) !!}</td>
                <td>{!! Form::text('date',\Carbon\Carbon::now()->format('m/d/Y'),array('class'=>'form-control','id'=>'date') ) !!}</td>
                <td>{!! Form::text('rating',null,array('class'=>'form-control') ) !!}</td>
                <td>
                    <button type="button" class="btn btn-primary" id="exam-save">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
        </table>
    </div>
</div>
<script>
    function loadExams() {

        $.ajax({
            method: "GET",
            url: '{{route('load-exam',$id)}}',

        }).done(function(data) {
            $('#prof_con').html(data);
        }).fail(function(){
            alert('yes');
        });
    }
    $('document').ready(function () {
        loadExams();
        $('#date').datepicker();
    });
    $('#exam-save').click(function () {
        $.ajax({
            method: "POST",
            url: '{{route('exam-save')}}',
            data:$('#exam_form').serialize(),
        }).done(function(data) {

            loadExams();
            $("#exam_form").trigger('reset');
        }).fail(function(){
            alert('yes');
        });
    });


</script>

