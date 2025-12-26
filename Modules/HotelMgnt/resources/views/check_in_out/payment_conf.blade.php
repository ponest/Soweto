<form action="{{route('room-confirm-payment')}}" id="payment_form" method="post" autocomplete="off">
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
                <select name="payment_method_id" id="payment_method_id" class="form-control form-control-air" required>
                    <option value="">Select</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-9">
                <label>Reference Number</label>
                <input type="text" name="payment_reference" id="payment_reference" class="form-control form-control-air">
            </div>
            <div class="col-3 hid_div_btn" style="display: none">
                <button  onclick="fetchDetails()" class="btn btn-primary" style="margin-top: 3.2vh">Verify</button>
            </div>

        </div>
        <div class="hid_div row mb-3" style="display: none">
            <div class="col">
                <label>Wallet Amount</label>
                <input type="number" id="wallet_amount" class="form-control form-control-air" readonly>
            </div>
            <div class="col">
                <label>Wallet Balance</label>
                <input type="number" id="wallet_balance" name="wallet_balance" class="form-control form-control-air" readonly>
            </div>
        </div>

        <div class="hid_disc_div row mb-3" style="display: none">
            <div class="col">
                <label>Discount Amount</label>
                <input type="number" id="discount_amount" class="form-control form-control-air" readonly>
            </div>
            <div class="col">
                <label>Discount Balance</label>
                <input type="number" id="discount_balance" name="discount_balance" class="form-control form-control-air" readonly>
            </div>
        </div>

        <div class="hid_adv_div row mb-3" style="display: none">
            <div class="col">
                <label>Advance Payment Amount</label>
                <input type="number" id="advance_amount" class="form-control form-control-air" readonly>
            </div>
            <div class="col">
                <label>Advance Payment Balance</label>
                <input type="number" id="advance_balance" name="advance_balance" class="form-control form-control-air" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Bill Amount</label>
                <input type="text" value="{{$bill_amount}}" id="bill_amount" class="form-control form-control-air" readonly>
            </div>
            <div class="col">
                <label>Paid Amount</label>
                <input type="number" name="paid_amount" id="paid_amount" class="form-control form-control-air" required>
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
