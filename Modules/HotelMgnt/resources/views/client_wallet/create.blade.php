<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('client-wallet.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Client Wallet</h5>
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
                                    <option value="{{$client->id}}">{{$client->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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
                            <label>Transaction Reference No</label>
                            <input type="text" name="transaction_reference_no" class="form-control form-control-air" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Wallet Amount</label>
                            <input type="number" name="wallet_amount" class="form-control form-control-air" required>
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
