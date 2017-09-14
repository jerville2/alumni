@php($galleries = 'active')
@extends('admin.admin_panel')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Gallery Albums</h2>
            </div>
            <div class="col-md-6">
                <div align="right" style="margin: 15px">
                    <a href="galleries/create" class="btn-main">Add new</a>
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-striped" style="margin-right: 20px">
            <thead>
            <tr style="background: #636363; color: white">
                <td><strong>Title</strong></td>
                <td align="center"><strong>Images</strong></td>
                <td align="center"><strong>Published</strong></td>
                <td align="center"><strong>Actions</strong></td>
            </tr>
            </thead>
            <tbody>
            @foreach($albums as $album)
                <tr>
                    <td><a href="{!! url('admin/galleries/album/'.$album->id) !!}">{{ $album->title }}</a></td>
                    <td align="center">{{ $album->images->count() }}</td>
                    <td align="center">
                        @if ($album->published == 1)
                            <i class="glyphicon glyphicon-ok" style="color: green"></i>
                        @else
                            <i class="glyphicon glyphicon-remove" style="color: red"></i>
                        @endif
                    </td>
                    <td align="center">
                        <a href="galleries/edit/{{ $album->id }}" class="btn-edit"><i class="glyphicon glyphicon-edit"></i> edit</a><span>
                            <a id="delete{{$album->id}}" class="btn-del"><i class="glyphicon glyphicon-trash"></i> delete</a>
                            <script>
                                $(document).ready(function(){
                                    $('#delete{{$album->id}}').click(function(){
                                        swal({
                                                title: "Delete Album?",
                                                text: "Are you Sure You want to delete {{$album->title}}?",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "Green",
                                                confirmButtonText: "Yes"
                                            },
                                            function(){
                                                window.location.href = 'galleries/delete/{{$album->id }}';
                                            });
                                    })
                                });
                            </script>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        {{ $albums->links() }}
    </div>

@endsection