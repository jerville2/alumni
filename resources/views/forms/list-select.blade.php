<div class="row">
    <div class="col-md-12">
        <table class="table">
            @forelse($item->choices as $c)
                <tr>
                    <td width="50%">
                        {{$c->text}}
                    </td>
                    <td width="25%">
                        @include('gen.delete-modal')
                    </td>
                    <td width="25%">
                        @include('gen.edit-modal')
                    </td>

                </tr>
            @empty
                &nbsp;
            @endforelse
        </table>
    </div>
</div>