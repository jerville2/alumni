@php($e = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Events</h2>
            </div>
            <div class="col-md-6">
                <div align="right" style="margin: 15px">
                    <a href="events/create" class="btn-main">Add new</a>
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
            @foreach($events as $event)
                <tr>
                    <td>{{ \Illuminate\Support\Str::words($event->title, 7) }}</td>
                    <td>{{ date('M d, Y', strtotime($event->date)) }}</td>
                    <td align="center">
                        @if ($event->published == 1)
                            <i class="glyphicon glyphicon-ok" style="color: green"></i>
                        @else
                            <i class="glyphicon glyphicon-remove" style="color: red"></i>
                        @endif
                    </td>
                    <td align="center">
                        <a href="events/edit/{{ $event->id }}" class="btn-edit"><i class="glyphicon glyphicon-edit"></i> edit</a><span>
                            <a id="delete{{$event->id}}" class="btn-del"><i class="glyphicon glyphicon-trash"></i> delete</a>
                            <script>
                                $(document).ready(function(){
                                    $('#delete{{$event->id}}').click(function(){
                                        swal({
                                                title: "Delete Event?",
                                                text: "Are you Sure You want to delete {{$event->title}}!",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "Green",
                                                confirmButtonText: "Yes"
                                            },
                                            function(){
                                                window.location.href = 'events/delete/{{$event->id }}';
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
        {{ $events->links() }}
    </div>

    @endsection