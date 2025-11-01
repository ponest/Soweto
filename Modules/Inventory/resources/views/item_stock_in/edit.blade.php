<form action="{{route('item-stock-in.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Item Stock In Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <select name="item_id" class="form-control form-control-air" required>
                    <option value="">Item</option>
                    @foreach($stock_items as $stock_item)
                        <option value="{{$stock_item->id}}" {{$stock_item->id == $item->item_id ? 'selected':''}}>{{$stock_item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <select name="supplier_id" class="form-control form-control-air" required>
                    <option value="">Suppliers</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}" {{$supplier->id == $item->supplier_id ? 'selected':''}}>{{$supplier->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="received_date" value="{{$item->received_date}}"
                       class="form-control form-control-air datePicker" placeholder="Received Date" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="number" name="bulk_quantity" value="{{$item->base_quantity}}" id="e_quantity"
                       class="form-control form-control-air" placeholder="Bulk Quantity" required>
            </div>
            <div class="col">
                <select name="bulk_unit_id" class="form-control form-control-air" required>
                    <option value="">Unit</option>
                    @foreach($units as $unit)
                        <option value="{{$unit->id}}" {{$unit->id == $item->base_unit_id ? 'selected':''}}>{{$unit->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="number" name="unit_price" id="e_unit_price" class="form-control form-control-air"
                     value="{{$item->unit_price}}"  placeholder="Unit Price" required>
            </div>
            <div class="col">
                <input type="number" name="total_price" id="e_total_price" class="form-control form-control-air"
                    value="{{$item->total_price}}"   placeholder="Total Price" readonly required>
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
