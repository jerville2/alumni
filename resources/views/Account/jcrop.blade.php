@extends('layouts.reg')
@section('hs')
    <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.min.css') }}"/>
    <script src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
    @endsection
@section('carousel')
    <div class="carousel"></div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" align="center">
                <div class="card">
                    <div class="panelcolor"> <h2>Crop Profile Picture</h2> </div>
                    <div class="panel-body">

                        <?= Form::open(['url'=> 'upjcrop' , 'method' => 'post', 'role'=>'form']) ?>
                            <button type="submit" class="btn-main fcolor" id="target">
                                Crop Picture
                            </button>
                            <hr>
                            <div class="col-lg-12">
                                <img src="{{ asset('storage'.Auth::user()->picture->location) }}" id="cropimage">

                            </div>
                        <?= Form::hidden('x', '', array('id' => 'x')) ?>
                        <?= Form::hidden('y', '', array('id' => 'y')) ?>
                        <?= Form::hidden('w', '', array('id' => 'w')) ?>
                        <?= Form::hidden('h', '', array('id' => 'h')) ?>


                        <?= Form::close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script type="text/javascript">
  $('#cropimage').Jcrop({
       aspectRatio: 1,
       setSelect: [ 25, 25, 500, 500 ],
       onChange: updateCoords
   });
   function updateCoords(c) {
       $('#x').val(c.x);
       $('#y').val(c.y);
       $('#w').val(c.w);
       $('#h').val(c.h);
   };
</script>
@endsection