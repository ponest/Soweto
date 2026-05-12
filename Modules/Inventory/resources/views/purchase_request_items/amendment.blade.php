<form action="{{route('purchase-request-item.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Purchase Stock Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <label>Item</label>
                <input type="text"  value="{{$item->stockItem?->name}}" class="form-control form-control-air" readonly>
                <input type="hidden" name="stock_item_id" value="{{$item->stock_item_id}}">
            </div>
            <div class="col">
                <label>Quantity</label>
                <input type="number" value="{{$item->quantity}}" id="am_quantity" class="form-control form-control-air"  readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Unit</label>
                <input type="text" value="{{$item->unit->name}}" class="form-control form-control-air"  readonly>
            </div>
            <div class="col">
                <label>Unit Price</label>
                <input type="number"  value="{{$item->unit_price}}"  class="form-control form-control-air" readonly>
            </div>
            <div class="col">
                <label>Total Price</label>
                <input type="text"  value="{{$item->total_price}}" class="form-control form-control-air"  readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Amended Unit Price</label>
                <input type="number"  value="{{$item->amended_unit_price}}" name="amended_unit_price" id="amended_unit_price" class="form-control form-control-air" required>
            </div>
            <div class="col">
                <label>Amended Total Price</label>
                <input type="text"  value="{{$item->amended_total_price}}" name="amended_total_price" id="amended_total_price" class="form-control form-control-air"  readonly>
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
