<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{$item->desc}}</div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <td>Item</td>
                            <td>Answer</td>
                            <td>&nbsp;</td>
                        </thead>
                        <tbody>
                           @foreach($item->h as $h)
                               <tr>
                                   <td>{{$h->r_item->desc}}</td>
                                   <td>{{$h->r_ans->text}}</td>
                                   <td>
                                       {!! Form::open( array( 'url'=>route ( 'hidden.destroy' , $h->id ),'method'=>'DELETE' ) ) !!}
                                            {{csrf_field()}}
                                            {!! Form::submit('Remove',array('class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </td>
                               </tr>
                           @endforeach

                               {!! Form::open(array('url'=>route('hidden.store'),'Method'=>'POST')) !!}
                                    {!! Form::hidden('h_id',$item->id) !!}
                                   <tr>
                                       <td>
                                           {{Form::select('hr_id',$items->pluck('desc','id')->toArray()
                                           ,null,array('class'=>'form-control','id'=>'hr') )}}
                                       </td>
                                       <td>
                                           {{Form::select('ch_id',$items->first()->choices()->pluck('text','id')->toArray()
                                          ,null,array('class'=>'form-control','id'=>'ch') )}}
                                       </td>
                                       <td>{{Form::submit('Add',array('class'=>'btn btn-primary'))}}</td>
                                   </tr>
                               {!! Form::close() !!}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadChoices() {
        $.ajax({
            method:'GET',
            url:'/hidden/loadCh/'+$('#hr').val(),

        }).done(function(data) {
            var str="";
            var obj;
            for (var i=0;i<=data.length-1;i++){

                str+="<option value='"+data[i].id+"' >"+data[i].text+"</option>"
            }
            ;        console.log(str);
            $('#ch').html(str);
        }).fail(function(){
            alert('yes');
        });
    }
    $('#hr').change(function () {
        loadChoices();
    });
</script>