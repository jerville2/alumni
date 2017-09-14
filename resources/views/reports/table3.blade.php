<style>
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: pink;
    }
</style>

<table class="table  table-bordered table-condensed table-responsive table-striped table-hover">
    <thead>
    <tr>

        <td align="center" colspan="{{$degs->count()?$degs->count()+3:4}}">{{$item->desc}}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="center">Choices</td>
        <td align="center" colspan="{{$degs->count()}}">{{$col->college}}</td>
        <td align="center">Total</td>

    </tr>
    <tr>
        <!-- display degrees -->
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        @forelse($degs as $d)
            @if($d->degs)
                <td align="center">{{$d->degs->abbr}}</td>
            @endif
        @empty
            <td>&nbsp;</td>
        @endforelse
        <td align="center">&nbsp;</td>
    </tr>
    </thead>
    <tbody>
    @foreach($rep as $r)
        @php($subTotal=0)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$r[0]}}</td>

            @forelse($degs as $d)

                <td align="right">
                    @php($key='deg'.$d->degree.'_count')
                    @if(array_key_exists($key,$r[1]))
                        {{$r[1]['deg'.$d->degree.'_count']}}
                    @else
                        0
                    @endif
                </td>

            @empty
                <td>&nbsp;</td>
            @endforelse
            <td align="right">{{$r[1]['total_count']}}</td>
        </tr>
    @endforeach
    <tr>
        <td>&nbsp;</td>
        <td align="center">Totals</td>
        @php($tot=0)
        @foreach($degs as $d)
            @php($index='t_'.$d->degree.'_count')
            <td align="right">{{$tc[$index]}}</td>
            @php($tot+=$tc[$index])
        @endforeach
        <td align="right">{{$tot}}</td>
    </tr>

    </tbody>
</table>