<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('purchase-request-item.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Purchase Stock Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{$requisition->id}}" name="purchase_request_id">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Item</label>
                            <select name="stock_item_id" id="stock_item_id" class="form-control form-control-air"  required>
                                <option value="">Select Item</option>
                                @foreach($stock_items as $stock_item)
                                    <option value="{{$stock_item->id}}">{{$stock_item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control form-control-air"  required>
                        </div>
                        <div class="col">
                            <label>Unit</label>
                            <input type="text" id="unit_name" class="form-control form-control-air"  readonly>
                            <input type="hidden" id="unit_id" name="unit_id">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control form-control-air" required>
                        </div>
                        <div class="col">
                            <label>Total Price</label>
                            <input type="text" id="total_price" name="total_price" class="form-control form-control-air"  readonly>
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
