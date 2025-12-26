<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('ingredients.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Ingredients</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="menu_id" value="{{$menu_id}}">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Stock Item</label>
                            <select  name="stock_item_id" id="stock_item_id" class="form-control form-control-air"  required>
                                <option value="">Select</option>
                                @foreach($stock_items as $stock_item)
                                    <option value="{{$stock_item->id}}">{{$stock_item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Quantity</label>
                            <input type="number" step="0.001" name="quantity" class="form-control form-control-air" required>
                        </div>
                        <div class="col">
                            <label>Unit</label>
                            <input type="hidden" id="unit_id" name="unit_id">
                            <input type="text" id="unit" class="form-control form-control-air" readonly>
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
