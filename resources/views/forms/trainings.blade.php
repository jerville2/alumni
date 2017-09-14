
<div class="row">
    <div class="col-md-12">
        <p> Professional Exams</p>
        <table class="table table-responsive table-condensed">
            <thead>
            <td align="center">Training</td>
            <td align="center">Duration</td>
            <td align="center">Training Agency</td>
            <td align="center">Type</td>
            <td align="center">&nbsp;</td>
            </thead>
            <tbody id="train_con">

            </tbody>
            <tr>
                {!! Form::open(array('url'=>route('training-save'),'method'=>'POST','id'=>'training_form')) !!}
                {!! Form::hidden('a_id',$id) !!}
                <td>{!! Form::text('title',null,array('class'=>'form-control','id'=>'college') ) !!}</td>
                <td>{!! Form::text('duration',null,array('class'=>'form-control') ) !!}</td>
                <td>{!! Form::text('training_agency',null,array('class'=>'form-control') ) !!}</td>
                <td>{!! Form::select('training_id',$types->pluck('Description','ID')->toArray()
                    ,null,array('class'=>'form-control','placeholder'=>'-------------------------') ) !!}
                </td>
                <td>
                    <button type="button" id="add-training" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
        </table>
    </div>
</div>
<script>
    function loadTrainings() {
        $.ajax({
            url:'{{route('load-trainings',$id)}}'
        }).done(function (data) {
            $('#train_con').html(data)
        }).fail(function () {

        });
    }
    $('document').ready(function () {
       loadTrainings();
    });

    $("#add-training").click(function () {
        $.ajax({
            method:'POST',
            url:'{{route('training-save')}}',
            data:$('#training_form').serialize(),
        }).done(function () {
            loadTrainings();
            $("#training_form").trigger('reset');

        }).fail(function () {

        });
    });

</script>

