<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-lg">
    <tr>
        <td>
            {{$header_prefix}}
        </td>
    </tr>
    <tr>
        <th>S/N</th>
        <th>Bill Ref No</th>
        <th>Payment Reference</th>
        <th>Confirmed By</th>
        <th>Confirmed At</th>
        <th>Payment Method</th>
        <th>Paid Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->bill?->reference_no}}</td>
            <td>{{$item->payment_reference}}</td>
            <td>{{$item->confirmedBy?->full_name}}</td>
            <td>{{date('d M Y H:i', strtotime($item->payment_confirmed_at))}}</td>
            <td>{{$item->paymentMethod?->name}}</td>
            <td>{{number_format($item->paid_amount)}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr style="font-weight: bold; background: whitesmoke">
        <td></td>
        <td colspan="5">Total</td>
        <td style="text-align: right">{{number_format($total_price)}}</td>
        <td></td>
    </tr>
    </tfoot>
</table>

