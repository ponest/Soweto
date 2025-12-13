<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route('item-stock-in.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Item Stock In Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-8">
                            <label>Purchase Request Number</label>
                            <select  name="purchase_request_id" id="purchase_request_id" class="form-control form-control-air" required>
                                <option value="">Purchase Request</option>
                                @foreach($purchase_requests as $purchase_request)
                                    <option value="{{$purchase_request->id}}">{{$purchase_request->request_number." - ".$purchase_request->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Suppliers</label>
                            <select  name="supplier_id" class="form-control form-control-air">
                                <option value="">Suppliers</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Item</label>
                            <select  name="item_id" id="item_id" class="form-control form-control-air" required>
{{--                                <option value="">Item</option>--}}
{{--                                @foreach($stock_items as $stock_item)--}}
{{--                                    <option value="{{$stock_item->id}}">{{$stock_item->name}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Received Date</label>
                            <input type="text" name="received_date" class="form-control form-control-air datePicker" placeholder="Received Date" required>
                        </div>
                        <div class="col-4">
                            <label>Bulk Quantity</label>
                            <input type="number" name="bulk_quantity" id="quantity" class="form-control form-control-air" placeholder="Bulk Quantity" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Bulk Unit</label>
                            <select  name="bulk_unit_id" class="form-control form-control-air" required>
                                <option value="">Bulk Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control form-control-air" placeholder="Unit Price" required>
                        </div>
                        <div class="col-4">
                            <label>Total Price</label>
                            <input type="number" name="total_price" id="total_price" class="form-control form-control-air" placeholder="Total Price" readonly required>
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
