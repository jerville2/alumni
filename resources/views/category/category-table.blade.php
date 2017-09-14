
    <table class="table table-striped">
        <thead>
        <td align="center">#</td>
        <td align="center">Category</td>
        @if(Route::currentRouteName()=='category.index')
            <td align="center">Published</td>
            <td align="center">Number of Items </td>
            <td>&nbsp;</td>
        @endif
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td align="center">{{$loop->index+1}}</td>
                <td align="center"><a href="{{route('category.show',$category->id)}}">{{$category->title}} </a></td>
                @if(Route::currentRouteName()=='category.index')
                    <td align="center">{{$category->published==1?'Published':'Not Published'}}</td>
                    <td align="center">{{$category->items->count()}}</td>
                    <td>
                        {{Form::open(array('url'=>route('category.destroy',$category->id),'method'=>'Delete' ))}}
                            {!! Form::submit('Delete',array('class'=>'btn btn-md btn-danger')) !!}
                        {{Form::close()}}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
