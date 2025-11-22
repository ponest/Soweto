<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('purchase-req-cost.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Additional Cost Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{$requisition->id}}" name="purchase_request_id">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Cost Item Name</label>
                            <input type="text" name="cost_item" class="form-control form-control-air" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Price</label>
                            <input type="number" name="amount" class="form-control form-control-air" required>
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
