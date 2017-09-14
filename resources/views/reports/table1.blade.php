<table class="table  table-bordered table-condensed">
    <thead>
    <tr>
        <td align="center" colspan="{{$college->count()+2}}">{{$item->desc}}</td>
    </tr>
    <tr>
        <td align="center">Choices</td>
        <td align="center" colspan="{{$college->count()}}">Colleges</td>
        <td align="center">Total</td>

    </tr>
    <tr>
        <td align="center">&nbsp;</td>
        @foreach($college as $c)
            <td align="center">{{$c->collegeabbr}}</td>

        @endforeach
        <td align="center">&nbsp;</td>
    </tr>
    </thead>
    <tbody>
    @php($overallTotal=0)
    @foreach($rep as $r)
        @php($subTotal=0)
        <tr>
            <td>{{$r->text}}</td>
            <td align="right">{{$r->gs_count }}@php($subTotal+=$r->gs_count)</td>
            <td align="right">{{$r->cafsd_count}} @php($subTotal+=$r->cafsd_count)</td>
            <td align="right">{{$r->casat_count}} @php($subTotal+=$r->casat_count)</td>
            <td align="right">{{$r->cas_count}} @php($subTotal+=$r->cas_count)</td>
            <td align="right">{{$r->cbea_count}} @php($subTotal+=$r->cbea_count)</td>
            <td align="right">{{$r->coe_count}} @php($subTotal+=$r->coe_count)</td>
            <td align="right">{{$r->chs_count}} @php($subTotal+=$r->chs_count)</td>
            <td align="right">{{$r->cit_count}} @php($subTotal+=$r->cit_count)</td>
            <td align="right">{{$r->cte_count}} @php($subTotal+=$r->cte_count)</td>
            <td align="right">{{$r->col_count}} @php($subTotal+=$r->col_count)</td>
            <td align="right">{{$r->com_count}} @php($subTotal+=$r->com_count)</td>
            <td align="right">{{$subTotal}}</td>
        </tr>
        @php($overallTotal+=$subTotal)
    @endforeach
    <tr>
        <td align="right" colspan="{{$college->count()+1}}">&nbsp;</td>
        <td align="right">{{$overallTotal}}</td>
    </tr>

    </tbody>
</table>