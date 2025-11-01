<form action="{{route('stock-issue.confirm')}}" method="post" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Confirm Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" value="{{$stock_item->id}}" name="id">
        <div class="row mb-3">
            <div class="col">
                <label>Balance</label>
                <input type="text" id="balance" class="form-control form-control-air" value="{{$balance}}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Requested Quantity</label>
                <input type="text" name="name" class="form-control form-control-air" value="{{$stock_item->requested_quantity}}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Issued Quantity</label>
                <input type="number" name="issued_quantity" class="form-control form-control-air" required>
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
