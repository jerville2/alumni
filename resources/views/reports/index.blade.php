@php($ca='active')
@extends('admin.admin_panel')
@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include($content)
            </div>
        </div>
        @if($rep!=null)
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @include('reports.report-gen')
                </div>
            </div>
        @endif
    </div>

@endsection