
<div class="row">
    <div class="col-md-12">
        <p> Professional Skills</p>
        <table class="table ">
            <thead>
            <td align="center">Skills</td>
            <td align="center">&nbsp;</td>
            </thead>
            <tbody id="skill_con">
          
            
            </tbody>
            <tr>
                {!! Form::open(array('url'=>route('skills-save'),'method'=>'POST','id'=>'skills_form')) !!}
                {!! Form::hidden('a_id',$id) !!}
                <td>{!! Form::text('skill',null,array('class'=>'form-control','id'=>'skill') ) !!}</td>
                <td>
                    <button  class="btn btn-primary" type="button" id="save-skills">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
        </table>
    </div>
</div>
<script>
    function load_skills() {
        $.ajax({
            method:'GET',
            url:'{{route('load-skills',$id)}}',
        }).done(function (data) {
            $('#skill_con').html(data);
        }).fail();
    }
    $('document').ready(function () {
        load_skills();

    });
    $('#save-skills').click(function (event) {
        event.preventDefault();
        $.ajax({
            method:'POST',
            url:'{{route('skills-save')}}',
            data:$('#skills_form').serialize(),
        }).done(function (data) {
            $('#skill').val('');
           load_skills();
        }).fail(function () {
            alert("Fail");
        });
    });

</script>

