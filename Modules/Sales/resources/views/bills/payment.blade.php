<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-sm">
    <tr>
        <th>S/N</th>
        <th>Payment Reference</th>
        <th>Payment Method</th>
        <th>Paid Amount</th>
        <th>Confirmed By</th>
        <th>Confirmed At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td style="width: 5%">{{++$key}}</td>
            <td class="desc_name">{{$item->payment_reference}}</td>
            <td style="width: 15%; text-align: right">{{$item->paymentMethod?->name}}</td>
            <td style="width: 15%; text-align: right">{{number_format($item->paid_amount)}}</td>
            <td style="width: 20%; text-align: right">{{$item->confirmedBy?->full_name}}</td>
            <td style="width: 18%;">{{date('d M Y H:i', strtotime($item->payment_confirmed_at))}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
