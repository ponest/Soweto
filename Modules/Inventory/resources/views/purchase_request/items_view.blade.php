<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-sm">
    <tr>
        <th colspan="5">Stock Items</th>
    </tr>
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td class="desc_name">{{isset($item->stockItem) ? $item->stockItem->name:'Not Defined'}}</td>
            <td style="text-align: right">{{number_format($item->quantity)." ".$item->unit->name}}</td>
            <td style="text-align: right">{{number_format($item->unit_price)}}</td>
            <td style="text-align: right">{{number_format($item->total_price)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr/>

<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-sm">
    <tr>
        <th colspan="3">Additional Cost</th>
    </tr>
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($additional_costs as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td class="desc_name">{{$item->cost_item}}</td>
            <td style="text-align: right">{{number_format($item->amount)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
