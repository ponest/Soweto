<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('stock-requisition-item.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Stock Requisition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{$requisition->id}}" name="stock_requisition_id">
                    <div class="row mb-3">
                        <div class="col">
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
                            <input type="number" name="requested_quantity" class="form-control form-control-air" placeholder="Quantity" required>
                        </div>
                        <div class="col">
                            <input type="text" id="unit_name" class="form-control form-control-air" placeholder="Unit" readonly>
                            <input type="hidden" id="unit_id" name="unit_id">
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
