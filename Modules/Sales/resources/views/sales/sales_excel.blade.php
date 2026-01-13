<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-lg">
    <tr>
        <td>
            {{$header_prefix}}
        </td>
    </tr>
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Sold At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td class="desc_name">{{$item->item_name}}</td>
            <td style="width: 15%; text-align: right">{{number_format($item->unit_price)}}</td>
            <td style="width: 15%; text-align: right">{{$item->quantity}}</td>
            <td style="width: 15%; text-align: right">{{number_format($item->total_price)}}</td>
            <td style="width: 15%;">{{date('d M Y H:i', strtotime($item->created_at))}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr style="font-weight: bold; background: whitesmoke">
        <td></td>
        <td colspan="3">Total</td>
        <td style="text-align: right">{{number_format($total_price)}}</td>
        <td></td>
    </tr>
    </tfoot>
</table>

