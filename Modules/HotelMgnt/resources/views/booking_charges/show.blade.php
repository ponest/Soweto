<!--Show Modal-->

<div class="modal-header">
    <h5 class="modal-title" id="create_modal">Booking Charges</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" id="datatable">
            <thead class="thead-default thead-md">
            <tr>
                <th>S/N</th>
                <th>Type</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Expense Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $key=>$item)
                <tr>
                    <td style="width: 5%">{{++$key}}</td>
                    <td class="desc_name">{{$item->type}}</td>
                    <td>{{$item->description}}</td>
                    <td style="text-align: right">{{number_format($item->unit_price)}}</td>
                    <td style="text-align: right">{{number_format($item->quantity)}}</td>
                    <td style="text-align: right">{{number_format($item->total_price)}}</td>
                    <td>{{date('d M Y', strtotime($item->expense_date))}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td colspan="4">Total</td>
                    <td style="text-align: right">{{number_format($total_price)}}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
        Close
    </button>
</div>
