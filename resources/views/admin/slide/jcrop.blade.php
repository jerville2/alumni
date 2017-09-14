@extends('admin.jcrop')
@section('hs')
    <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.min.css') }}"/>
    <script src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
@endsection
@section('admin')
    <div class="row">
        <div class="col-md-12" align="center">
            <div class="card">
                <div style="background: #3c3c3c; color: white"> <h2>Crop Slide Show</h2> </div>
                <div class="panel-body">

                    <?= Form::open(['url'=> 'admin/slides/upjcrop/'.$image->id , 'method' => 'post', 'role'=>'form']) ?>
                    <button type="submit" class="btn-main" id="target">
                        Crop Picture
                    </button>
                    <hr>
                    <div class="col-lg-12">
                        <img src="{{ asset('storage'.$image->location) }}" id="cropimage">

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

    <script type="text/javascript">
        $('#cropimage').Jcrop({
            aspectRatio: 2.4,
            setSelect: [ 0, 25, 1200, 500 ],
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