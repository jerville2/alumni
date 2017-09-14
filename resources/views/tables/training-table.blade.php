@foreach($trainings as $t)
    <tr>
        <td align="center">{{$t->title }}</td>
        <td align="center">{{$t->duration}}</td>
        <td align="center">{{$t->training_agency}}</td>
        <td align="center">{{$t->training?$t->training->Description:''}}</td>
        <td>
            {!! Form::open(array('url'=>route('training-delete',$t->id),'method'=>'Delete','id'=>'del-training'.$t->id)) !!}
                <button class="btn btn-warning" type="button" id="training-del{{$t->id}}">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            {!! Form::close() !!}
        </td>
    </tr>
    <script>
        $('#training-del{{$t->id}}').click(function () {
            $.ajax({
                method:'POST',
                url:'{{route('training-delete',$t->id)}}',
                data:$('#del-training{{$t->id}}').serialize(),
            }).done(function () {
                loadTrainings();
            }).fail(function () {

            });
        });
    </script>
@endforeach