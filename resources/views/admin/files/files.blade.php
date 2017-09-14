@php($f = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Downloadable Files</h2>
            </div>
            <div class="col-md-6">
                <div align="right" style="margin: 15px">
                    <a href="files/create" class="btn-main">Add new</a>
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-striped" style="margin-right: 20px">
            <thead>
            <tr style="background: #636363; color: white">
                <td><strong>Title</strong></td>
                <td><strong>Date</strong></td>
                <td align="center"><strong>Published</strong></td>
                <td align="center"><strong>Actions</strong></td>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->title }}</td>
                    <td>{{ date('M d, Y', strtotime($file->dldate)) }}</td>
                    <td align="center">
                        @if ($file->published == 1)
                            <i class="glyphicon glyphicon-ok" style="color: green"></i>
                        @else
                            <i class="glyphicon glyphicon-remove" style="color: red"></i>
                        @endif
                    </td>
                    <td align="center">
                        <a href="files/edit/{{ $file->dl_code }}" class="btn-edit"><i class="glyphicon glyphicon-edit"></i> edit</a><span>
                            <a id="delete{{$file->dl_code}}" class="btn-del"><i class="glyphicon glyphicon-trash"></i> delete</a>
                            <script>
                                $(document).ready(function(){
                                    $('#delete{{$file->dl_code}}').click(function(){
                                        swal({
                                                title: "Delete File?",
                                                text: "Are you Sure You want to delete {{$file->title}}!",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "Green",
                                                confirmButtonText: "Yes"
                                            },
                                            function(){
                                                window.location.href = 'files/delete/{{$file->dl_code }}';
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
        {{ $files->links() }}
    </div>

    @endsection