
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
            <tbody id="con">


            </tbody>
            <tr>
                {!! Form::open(array('url'=>route('educ-save'),'method'=>'POST','id'=>'educ')) !!}
                {!! Form::hidden('a_id',$id,array('id'=>'a_id')) !!}
                <td>{!! Form::select('college',$colleges ->pluck('college','college_code')->toArray()
                   ,null,array('class'=>'form-control','id'=>'college') ) !!}</td>
                <td><div id="deg">{!! Form::select('degree',
                                     $colleges->first()->degrees->pluck('degree','id')->toArray(),null,array('class'=>'form-control','id'=>'degrees') ) !!}
                    </div>
                </td>
                <td>{!! Form::select('ay',array(null=>'----------')+
                        $ay->reverse()->pluck('Description','ID')->toArray(),
                        null,array('class'=>'form-control') ) !!}
                </td>
                <td>{!! Form::select('honor',array(null=>'----------')+$honors->pluck('Description','ID')->toArray(),null,array('class'=>'form-control','placeholder'=>'-------') ) !!}</td>
                <td>
                    <button type="button" class="btn btn-primary" id="sub">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
        </table>
    </div>
</div>
<script>
    function loadEduc() {

        $.ajax({
           // method: "GET",
            url: '{{route('load-educ',$id)}}',
        }).done(function(data) {
            $('#con').html(data);
        }).fail(function(){
            alert('yes');
        });
    }
    function loadDegs() {
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
    }
    $('document').ready(function () {
        loadEduc();

    })
    $('#college').change(function () {
        loadDegs()

    });

    //this is the submit of educt table
    $('#sub').click(function () {
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: '{{route('educ-save')}}',
            data:$('#educ').serialize(),

        }).done(function(data) {
           loadEduc();
            $("#educ").trigger('reset');
            loadDegs();
        }).fail(function(){
            alert('yes');
        });
    });
</script>
