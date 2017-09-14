@extends('layouts.app2')

@section('content')
    <style>

    </style>
    <div class="container" id="form">

        <div class="row">

            <div class="col-md-3 ">
                <ul class="nav nav-pills nav-stacked" id="navi" >

                    @foreach($category as $ca)
                        <li class="list-group-item-success {{$ca->id==$c?'active':''}}">
                            <a  href="{{route('gts',['id'=>$id,'c'=>$ca->id])}} " style="text-decoration-color: white">{{$ca->title}}</a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-md-9 " >

                <div class="panel panel-primary" >

                    <div class="panel-heading" align="center"> {{$cat!==null?$cat->title:''}}</div>
                    <div class="panel-body">
                        @include('gen.actions')
                        @include('gen.reload')
                        @if($cat->id==1)
                            @include('forms.educform')
                            @include('forms.profexam')
                        @endif
                        @if($cat->id==4)
                           @include('forms.trainings')
                        @endif
                        @if($cat!=null)
                    {!! Form::open(array('url'=>route('save'),'method'=>'Post')) !!}
                        {{Form::hidden('a_id',$id)}}
                        {{Form::hidden('cat',$cat->id)}}
                    @foreach($cat->items as $item)
                        @include($item->form->form)
                    @endforeach
                    <br>
                    @if($cat->items->count())
                        <div class="row">
                            <div class=" col-md-10">&nbsp;</div>
                            <div class="col-md-2">
                                {{Form::submit('Save',array('class'=>'btn btn-success'))}}
                            </div>
                        </div>
                    @endif
                        <br>
                    {!! Form::close() !!}
                     @if($cat->id==1)
                           @include('forms.profskills')
                     @endif

                @endif

                @include('gen.onLoad')
            </div>
        </div>


            </div>
        </div>
    </div>

@endsection
