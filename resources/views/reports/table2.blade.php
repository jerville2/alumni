<style>
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: pink;
    }
</style>
<table class="table  table-bordered table-hover table-striped table-condensed">
    <thead>
    <tr>
        @php($lim=$item->op_val)

        <td align="center" colspan="{{$item->choices->count()+3}}">{{$item->desc}}</td>
    </tr>


    </thead>
    <tbody>

        @foreach($degs as $d)
            <tr>
                <td align="center" colspan="{{$item->choices->count()+2}}">{{$d->degs->degree}}</td>
            </tr>
            <tr>
                <td align="center">#</td>
                <td align="center">Choices</td>
                <td align="center" colspan="{{$lim}}">&nbsp;</td>

            </tr>
            <tr>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                @for($i=1;$i<=$lim;$i++)
                    <td align="center">{{$i}}</td>

                @endfor


            </tr>
                @foreach($rep as $r)
                    <tr>
                        <td align="center">{{$loop->index+1}}</td>
                        <td>{{$r[1]}}</td>

                        @for($i=1;$i<=$lim;$i++)
                            @php($index='college_'.$d->degree.'_'.$r[0].'_'.$i.'_count')
                            @if(array_key_exists($index,$r[2]))
                                <td align="right">
                                    {{$r[2][$index]}}
                                </td>
                            @else
                                <td align="right">0</td>
                            @endif
                        @endfor


                    </tr>

                @endforeach
        @endforeach

    </tbody>
</table>