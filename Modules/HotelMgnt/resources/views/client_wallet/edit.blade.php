<form action="{{route('client-wallet.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Client Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <label>Client Name</label>
                <select  name="client_id" class="form-control form-control-air" required>
                    <option value="">Client Name</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}" {{$client->id == $item->client_id ? 'selected':''}}>{{$client->full_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Payment Method</label>
                <select name="payment_method_id" class="form-control form-control-air" required>
                    <option value="">Select</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{$payment_method->id}}" {{$payment_method->id == $item->payment_method_id ?'selected':''}}>{{$payment_method->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Payment Description</label>
                <input type="text" name="description" value="{{$item->description}}" class="form-control form-control-air" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Transaction Reference No</label>
                <input type="text" name="transaction_reference_no" value="{{$item->transaction_reference_no}}" class="form-control form-control-air">
            </div>
            <div class="col">
                <label>Wallet Amount</label>
                <input type="number" name="wallet_amount" value="{{$item->wallet_amount}}" class="form-control form-control-air" required>
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
