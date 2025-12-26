<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('advance-payment.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Advance Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="client_id" name="client_id">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Booking Reference</label>
                            <select name="booking_id" id="booking_id" class="form-control form-control-air" required>
                                <option value="">---Select---</option>
                                @foreach($bookings as $booking)
                                    <option value="{{$booking->id}}" data-client="{{$booking->client_id}}">{{$booking->reference_number." - Room ". $booking->room?->room_number}}</option>
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
                                    <option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Transaction Reference Number</label>
                            <input type="text" name="transaction_reference_number" placeholder="For Cash Dont Fill here" class="form-control form-control-air">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Amount Paid</label>
                            <input type="text" name="amount" class="form-control form-control-air" required>
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
        </div>
    </div>
</div>
