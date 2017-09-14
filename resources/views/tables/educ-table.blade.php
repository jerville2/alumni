@foreach($educ as $ed)
    <tr>
        <td align="center">{{$ed->col->college}}</td>
        <td align="center">{{$ed->deg->degree}}</td>
        <td align="center">{{$ed->ay_d?$ed->ay_d->Description:''}}</td>
        <td align="center">{{$ed->h?$ed->h->Description:''}}</td>
        <td align="center">&nbsp;</td>
        <td>
            {!! Form::open(array('url'=>route('ed-delete',$ed->id),'method'=>'Delete')) !!}
            {{Form::hidden('id',$ed->id,array('id'=>'id'.$ed->id))}}
            <button class="btn btn-warning" type="button" id="deleduc{{$ed->id}}">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
    <script>
        $('#deleduc{{$ed->id}}').click(function (event) {
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: '/educ/'+$('#id{{$ed->id}}').val(),
                data:$('#educ').serialize(),

            }).done(function(data) {
                loadEduc();
            }).fail(function(){
                alert('yes');
            });
        });

    </script>
@endforeach

