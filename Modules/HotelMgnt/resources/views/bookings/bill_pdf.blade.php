<div>
    <h3>Bill Holder: </h3>
</div>

<table>
    <thead>
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Cost</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bill_items as $key=>$bill_item)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$bill_item->item_name}}</td>
            <td>{{$bill_item->total_price}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
