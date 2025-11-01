<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-lg">
    <tr>
        <th>S/N</th>
        <th>Item Name</th>
        <th>Proposed Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td class="desc_name">{{$item->menuItem?->name}}</td>
            <td style="text-align: right">{{number_format($item->price)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
