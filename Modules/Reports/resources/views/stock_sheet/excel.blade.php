<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-lg">
    <tr>
        <th colspan="9" class="text-center">{{$header}}</th>
    </tr>
    <tr>
        <th>S/N</th>
        <th>Item</th>
        <th>OP</th>
        <th>ADD</th>
        <th>TOTAL</th>
        <th>CL</th>
        <th>SOLD</th>
        <th>PRICE</th>
        <th>TOTAL PRICE</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td>{{++$key}}</td>
            <td class="desc_name">{{$item->stockItem?->name}}</td>
            <td style="text-align: right">{{number_format($item->opening_stock)}}</td>
            <td style="text-align: right">{{number_format($item->additional_stock)}}</td>
            <td style="text-align: right">{{number_format($item->total_stock)}}</td>
            <td style="text-align: right">{{number_format($item->closing_stock)}}</td>
            <td style="text-align: right">{{number_format($item->sold_qty)}}</td>
            <td style="text-align: right">{{number_format($item->unit_price)}}</td>
            <td style="text-align: right">{{number_format($item->total_price)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
