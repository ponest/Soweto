<form action="{{route('stock-requisition-item.update',$item)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <select name="stock_item_id" id="e_stock_item_id" class="form-control form-control-air" required>
                    <option value="">Select Item</option>
                    @foreach($stock_items as $stock_item)
                        <option value="{{$stock_item->id}}" {{$stock_item->id == $item->stock_item_id ? 'selected':''}}>{{$stock_item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="number" name="requested_quantity" class="form-control form-control-air"
                      value="{{$item->requested_quantity}}" placeholder="Quantity" required>
            </div>
            <div class="col">
                <input type="text" id="e_unit_name" value="{{$item->unit->name}}" class="form-control form-control-air" placeholder="Unit" readonly>
                <input type="hidden" id="e_unit_id" value="{{$item->unit_id}}" name="unit_id">
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
