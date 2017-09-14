<style>
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: pink;
    }
</style>

<table class="table  table-bordered table-condensed table-striped table-hover">
    <thead>
    <tr>
        <td>&nbsp;</td>
        <td align="center" colspan="{{$degs->count()+2}}">{{$item->desc}}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="center">Answers</td>
        <td align="center" colspan="{{$degs->count()}}">Degrees</td>
        <td align="center">Total</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        @foreach($degs as $deg)
            @if($deg->degs)
                <td align="center">{{$deg->degs->abbr}}</td>
            @endif

        @endforeach
        <td align="center">&nbsp;</td>
    </tr>
    </thead>
    <tbody>
        @php($total=0)
        @forelse($rep as $r)
            <tr>
                <td align="center">{{$loop->index+1}}</td>
                <td>{{$r[0]}}</td>
                @forelse($degs as $deg)
                    @php($key='deg'.$deg->degree.'_count')
                    @if(array_key_exists($key,$r[1]))
                        <td align="right">{{$r[1][$key]}}</td>
                    @else
                        <td align="right">0</td>
                    @endif
                @empty
                    <td colspan="{{$degs->count()}}"></td>
                @endforelse
                <td align="right">
                    {{$r[1]['total_count']}}
                    @php($total+=$r[1]['total_count'])
                </td>
            </tr>
         @empty
        @endforelse
        <td align="right" colspan="{{$degs->count()+2}}">&nbsp;</td>
        <td align="right">{{$total}}</td>
    </tbody>
</table>