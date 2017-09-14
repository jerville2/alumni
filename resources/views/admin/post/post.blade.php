@php($p = 'active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Reported Post</h2>
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
                <td><strong>Post</strong></td>
                <td><strong>Date Reported</strong></td>
                <td><strong>Concern</strong></td>
                <td align="center"><strong>Posted by</strong></td>
            </tr>
            </thead>
            <tbody>
            @if ($posts->count() == 0)
                <tr>
                    <td colspan="4">
                        <h3>No Reports</h3>
                    </td>
                </tr>
            @endif
            @foreach($posts as $post)
                <tr>
                    <td><a href="/admin/post/view/{{ $post->id }}" target="_blank">{!! \Illuminate\Support\Str::words(strip_tags($post->post), 6) !!}</a></td>
                    <td>{{ date('M d, Y  h:i:s a', strtotime($post->date_reported)) }}</td>
                    <td>{{ \Illuminate\Support\Facades\DB::table('post_report')->where('id', $post->report_id)->first()->type }}</td>
                    <td align="center">{{ $post->user->alumni->firstname.' '.$post->user->alumni->middlename.' '.$post->user->alumni->surname }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
    @endsection