<form action="{{route('room-confirm-payment')}}" method="post" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Payment Confirmation Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="hidden" name="booking_id" value="{{$item->booking_id}}">
        <div class="row mb-3">
            <div class="col">
                <label>Payment Method</label>
                <select name="payment_method_id" class="form-control form-control-air" required>
                    <option value="">Select</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Reference Number</label>
                <input type="text" name="payment_reference" class="form-control form-control-air">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Bill Amount</label>
                <input type="text" value="{{$bill_amount}}" class="form-control form-control-air" readonly>
            </div>
            <div class="col">
                <label>Paid Amount</label>
                <input type="number" name="paid_amount" class="form-control form-control-air" required>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
            Close
        </button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>
