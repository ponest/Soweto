<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-lg">
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Item Description</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td>{{$item->item_name}}</td>
            <td style="width: 15%; text-align: right">{{$item->item_description}}</td>
            <td style="width: 15%; text-align: right">{{number_format($item->unit_price)}}</td>
            <td style="width: 15%; text-align: right">{{number_format($item->quantity)}}</td>
            <td style="width: 15%; text-align: right">{{number_format($item->total_price)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
