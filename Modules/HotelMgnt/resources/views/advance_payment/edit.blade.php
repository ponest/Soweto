<form action="{{route('advance-payment.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Advance Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" id="client_id" value="{{$item->client_id}}" name="client_id">
        <div class="row mb-3">
            <div class="col">
                <label>Booking Reference</label>
                <select name="booking_id" id="booking_id" class="form-control form-control-air" required>
                    <option value="">---Select---</option>
                    @foreach($bookings as $booking)
                        <option value="{{$booking->id}}" {{$booking->id == $item->booking_id ? 'selected':''}} data-client="{{$booking->client_id}}">{{$booking->reference_number." - Room ". $booking->room?->room_number}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Payment Method</label>
                <select name="payment_method_id" id="payment_method" class="form-control form-control-air" required>
                    <option value="">---Select---</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{$payment_method->id}}" {{$payment_method->id == $item->payment_method_id ? 'selected':''}}>{{$payment_method->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Transaction Reference Number</label>
                <input type="text" name="transaction_reference_number" value="{{$item->transaction_reference_number}}" placeholder="For Cash Dont Fill here" class="form-control form-control-air">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Amount Paid</label>
                <input type="text" name="amount" value="{{$item->amount}}" class="form-control form-control-air" required>
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
