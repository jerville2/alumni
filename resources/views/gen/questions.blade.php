<div class="row">
    <div class="col-md-12">
        @if( $catf!=1 )

            <h3><a href="{{route('hidden.edit',$item->id)}}">
                    <b>{!! $item->desc !!}</b>

                </a>

            </h3>
            <div class="row">
                <div class="col-md-3">
                    @include('gen.delete-item-modal')
                </div>
                <div class="col-md-3">
                    @include('gen.edit-question-modal')
                </div>
                @if($item->type!=1)
                    <div class="col-md-3">
                        @include('gen.add-choices-modal')
                    </div>
                @endif
            </div>
            <br>


        @else
            <h3><b>{!! $item->desc !!}</b></h3>
        @endif
    </div>
</div>