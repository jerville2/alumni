<div class="container">

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading"><h4>Edit Category</h4></div>
                <div class="panel-body">
                    {{Form::model($cat,array('url'=>route('category.update',$cat->id),'method'=>'PUT'))}}
                    <div class="form-group">
                        {{Form::label('Title')}}
                        {{Form::text('title',null,array('class'=>'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Published')}}
                        {{Form::select('published',['Unpublished','Published'],null,array('class'=>'form-control'))}}
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8">
                            {{Form::submit('Update',array('class'=>'btn btn-success'))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading"><h4>Categories</h4></div>
                <div class="panel-body">
                    @include('category.category-table')
                </div>
            </div>
        </div><!-- end of col-md-4-->
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">{{$cat->title}}</div>
                <div class="panel-body">

                        @foreach($cat->items as $item)
                            @include($item->form->form)
                        @endforeach

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>New Item</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::open(array('url'=>route('item.store'),'method'=>'POST'))}}
                                    {{Form::hidden('cat_id',$cat->id)}}
                                    <div class="form-group">
                                        {{Form::label('Description')}}
                                        {{Form::text('desc',null,array('class'=>'form-control'))}}

                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Type')}}
                                        {{Form::select('type',$types->pluck('desc','id')->toArray(),null,array('class'=>'form-control','id'=>'type'))}}
                                    </div>
                                    <div class="row" id="rate" style="display: none">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{Form::label('Score')}}
                                                {{Form::select('rate',[
                                                    1,2,3,4,5,6,7,8,9,10
                                                ],null,array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="choices" style="display: none">
                                        <div class="col-md-12">
                                            <table class="table" id="choiceTB">
                                                <tr>
                                                    <td>{{Form::text('choice',null,array('class'=>'form-control','id'=>'choice'))}}</td>
                                                    <td>
                                                        <button id="add" type="button" class="btn btn-primary">
                                                            <span class="glyphicon glyphicon-plus">Add</span>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            {{Form::submit('Save',array('class'=>'btn btn-success'))}}
                                        </div>
                                    </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#type').change(function () {

        if( parseInt( $('#type').val())>=2 ){
            if(parseInt( $('#type').val())==4)
                $('#rate').show();
            else
                $('#rate').hide();
            $('#choices').show();
        }else{
            $('#choices').hide();
            $('#rate').hide();
        }

    });
    $('#add').click(function () {
        $('#choiceTB').append('<tr>'+
            "  <td><input type='text' value= '"+$('#choice').val()+"' class='form-control' name='choices[]'></td>"+
            " <td>&nbsp;</td>"+
            '</tr>');
        $('#choice').val('');
    });

</script>
