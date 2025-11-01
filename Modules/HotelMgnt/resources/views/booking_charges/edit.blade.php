<form action="{{route('booking-charges.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Booking Charges</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <label>Type</label>
                <select name="type" class="form-control form-control-air dd_select" style="width: 100%" required>
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                        <option value="{{$type}}" {{$type == $item->type ? 'selected':''}}>{{$type}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col">
                <label>Description</label>
                <textarea name="description" class="form-control form-control-air" required>{{$item->description}}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Amount</label>
                <input type="number" name="amount" value="{{$item->amount}}" class="form-control form-control-air" required>
            </div>
            <div class="col">
                <label>Expense Date</label>
                <input type="text" name="expense_date" value="{{$item->expense_date}}" class="form-control form-control-air datePicker" required>
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
