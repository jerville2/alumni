@php($l = 'active')
@extends('directory.directory')
@section('directory')
    <div class="container">
        <div class="panelcolor" align="center">
            <h2 style="margin-top: -0px"><strong>Directory List</strong></h2>
        </div>
        <div align="center">
            {{ $alumni->links() }}
        </div>
        <table class="table table-striped">
            <thead>
            <tr class="panelcolor fcolor">
                <td></td>
                <td>Name</td>
                <td>College</td>
                <td>Degree</td>
                <td>Semester</td>
                <td>AY</td>
            </tr>
            </thead>
            <tbody>
            @foreach($alumni as $alum)
                <tr>
                    <td>
                        <a href="/alumni/view/{{$alum->reg_id}}">
                            @if($alum->user->picture == null)
                                <img class="img-circle" width="50" height="50" src="{{ asset('storage/uploads/imgs/default.png') }}">
                            @else
                                <img class="img-circle" width="50" height="50" src="{{ asset('storage'.$alum->user->picture->location) }}">
                            @endif
                        </a>
                    </td>
                    <td><a href="/alumni/view/{{$alum->reg_id}}">{{ strtoupper($alum->surname.', '.$alum->firstname.' '.$alum->middlename) }}</a> </td>
                    <td>{{ $alum->college->abbr }}</td>
                    <td>
                        @if($alum->degree_code == 0)
                            N/A
                        @else
                            {{ $alum->degree->degree }}
                        @endif
                    </td>
                    <td>
                        @if($alum->sem_graduated == 1)
                            1st Sem.
                        @elseif($alum->sem_graduated == 2)
                            2nd Sem.
                        @else
                            Summer
                        @endif
                    </td>
                    <td>{{ $alum->year_graduated }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div align="center">
            {{ $alumni->links() }}
        </div>
    </div>
    <div class="container">
        <hr class="featurette-divider">

        <footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2017 Mariano Marcos State University. All Rights Reserved.</p>
        </footer>
    </div>
    @endsection