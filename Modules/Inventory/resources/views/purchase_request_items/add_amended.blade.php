<form action="{{route('purchase-request-item.feed-amended')}}" method="post" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Add Amended Stock Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" value="{{$request->id}}" name="current_request_id">
        <div class="row mb-3">
            <div class="col">
                <label>Item</label>
                <select name="stock_item_id[]" id="amend_stock_item_id" class="form-control form-control-air" multiple required>
                    <option value="">Select Item</option>
                    @foreach($items as $item)
                        <option value="{{$item->id}}">{{$item->stockItem?->name." - ".number_format($item->total_price)}}</option>
                    @endforeach
                </select>
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
