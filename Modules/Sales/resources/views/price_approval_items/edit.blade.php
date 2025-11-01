<form action="{{route('price-approval-item.update',$item)}}" method="post" autocomplete="off">
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
                <label>Item Name</label>
                <select name="item_id" id="item_id" class="form-control form-control-air" required>
                    <option value="">Select Item</option>
                    @foreach($stock_items as $stock_item)
                        <option value="{{$stock_item->id}}" {{$stock_item->id == $item->item_id ? 'selected':''}}>{{$stock_item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Price</label>
                <input type="number" name="price" class="form-control form-control-air"
                      value="{{$item->price}}" required>
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
