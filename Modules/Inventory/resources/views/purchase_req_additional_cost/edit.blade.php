<form action="{{route('purchase-req-cost.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Addition Cost Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <label>Cost Item Name</label>
                <input type="text" name="cost_item" value="{{$item->cost_item}}" class="form-control form-control-air" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Price</label>
                <input type="number" name="amount" value="{{$item->amount}}" class="form-control form-control-air" required>
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
