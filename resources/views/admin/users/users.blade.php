@php($u = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Users</h2>
            </div>
            <div class="col-md-6" style="top: 20px">
                <form action="/admin/users/q" method="get" class="form-horizontal">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="input-group">
                            <label for="search" class="sr-only">Search</label>
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search Users" value="" />
                            <span class="input-group-btn">
                                <button class="btn" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <table class="table table-striped">
            <thead>
            <tr style="background: #636363; color: white">
                <td><strong>Name</strong></td>
                <td align="center"><strong>Student Number</strong></td>
                <td align="center"><strong>ID Card</strong></td>
                <td align="center"><strong>Actions</strong></td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ strtoupper($user->surname.', '.$user->firstname.' '.substr($user->middlename, 0, 1).'.') }}</td>
                    <td align="center">{{ $user->student_number }}</td>
                    <td align="center">
                        @if($user->due_date < \Carbon\Carbon::now()->format('Y-m-d') and $user->idcard == 1)
                            <strong style="color: red">Expired</strong>
                            @else
                            @if($user->idcard == 1)
                                <strong style="color: green">Claimed</strong>
                            @else
                                <strong style="color: goldenrod">Unclaimed</strong>
                            @endif
                        @endif
                    </td>
                    <td align="center"><a href="{!! url('admin/users/info/'.$user->reg_id) !!}" class="btn-edit">membership info</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
    @endsection