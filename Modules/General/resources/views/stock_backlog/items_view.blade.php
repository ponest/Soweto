<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-md">
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Quantity</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td class="desc_name">{{isset($item->stockItem) ? $item->stockItem->name:'Not Defined'}}</td>
            <td style="text-align: right">{{number_format($item->quantity)." ".$item->unit->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
