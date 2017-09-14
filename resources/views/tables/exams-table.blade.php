@foreach($prof as $p)
    <tr>
        <td align="center">{{$p->profD?$p->profD->Description:'' }}</td>
        <td align="center">{{$p->date_exam!=null?$p->date_exam:''}}</td>
        <td align="center">{{$p->rating?$p->rating:''}}</td>
        <td>
            {!! Form::open(array('url'=>route('prof-delete',$p->id),'method'=>'Delete','id'=>'exam_delete_form'.$p->id)) !!}
            {{Form::hidden('id',$p->id,array('id'=>'ex_id'.$p->id))}}
            <button class="btn btn-warning" type="button" id="del-exams{{$p->id}}">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
    <script>
        $('#del-exams{{$p->id}}').click(function () {
            $.ajax({
                method:'GET',
                url: '/exam/{{$p->id}}',
               // data:$('#exam_delete_form{{$p->id}}').serialize(),
            }).done(function(data) {
               loadExams();
            }).fail(function(xhr){
               console.log($('#exam_delete_form{{$p->id}}').serialize());
            });
        });
    </script>
@endforeach

