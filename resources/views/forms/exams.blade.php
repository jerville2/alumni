
<div class="row">
    <div class="col-md-12">
        <p> Educational Attainment</p>
        <table class="table table-responsive table-condensed">
            <thead>
            <td align="center">College</td>
            <td align="center">Degree</td>
            <td align="center">Year Graduated</td>
            <td align="center">Honor</td>
            <td align="center">&nbsp;</td>
            </thead>
            <tbody>
            @foreach($educ as $ed)
                <tr>
                    <td align="center">{{$ed->col->collegeabbr}}</td>
                    <td align="center">{{$ed->deg->degree}}</td>
                    <td align="center">{{$ed->ay_d->Description}}</td>
                    <td align="center">{{$ed->h->Description}}</td>
                    <td align="center">&nbsp;</td>
                    <td>
                        {!! Form::open(array('url'=>route('ed-delete',$ed->id),'method'=>'Delete')) !!}
                        <button class="btn btn-warning">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            <tr>
                {!! Form::open(array('url'=>route('educ-save'),'method'=>'POST')) !!}
                {!! Form::hidden('a_id',$id) !!}
                <td>{!! Form::select('college',$colleges->pluck('collegeabbr','id')->toArray(),null,array('class'=>'form-control','id'=>'college') ) !!}</td>
                <td><div id="deg">{!! Form::select('degree',
                                     $colleges->first()->degrees->pluck('degree','id')->toArray(),null,array('class'=>'form-control','id'=>'degrees') ) !!}
                    </div>
                </td>
                <td>{!! Form::select('ay',$ay->pluck('Description','ID')->toArray(),null,array('class'=>'form-control') ) !!}</td>
                <td>{!! Form::select('honor',$honors->pluck('Description','ID')->toArray(),null,array('class'=>'form-control','placeholder'=>'-------') ) !!}</td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus">Add</span>
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>

    $('#college').change(function () {

        $.ajax({
            url: '/gtsdeg/'+$('#college').val(),

        }).done(function(data) {
            var str="";
            var obj;
            for (var i=0;i<=data.length-1;i++){

                str+="<option value='"+data[i].id+"' >"+data[i].degree+"</option>"
            }
            ;        console.log(str);
            $('#degrees').html(str);
        }).fail(function(){
            alert('yes');
        });
    });
</script>
