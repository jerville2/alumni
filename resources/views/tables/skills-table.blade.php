@foreach($skills as $skill)
    <tr>
        <td align="center">{{$skill->skill}}</td>
        <td>
            {!! Form::open(array('url'=>route('skills-delete',$skill->id),'method'=>'Delete','id'=>'del-skills'.$skill->id)) !!}
            <button class="btn btn-warning" type="button" id="del-skills{{$skill->id}}">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
    <script>
        $("#del-skills{{$skill->id}}").click(function () {
           $.ajax({
               method:'POST',
               url:'{{route('skills-delete',$skill->id)}}',
               data:$('#del-skills{{$skill->id}}').serialize(),
           }).done(function () {
               load_skills();
           }).fail();
        });
    </script>
@endforeach