<!--Create Modal-->
<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('booking-charges.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Booking Charges</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="booking_id" value="{{$booking_id}}">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Type</label>
                            <select name="type" class="form-control form-control-air dd_select" style="width: 100%" required>
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col">
                            <label>Description</label>
                            <textarea name="description" class="form-control form-control-air" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control form-control-air" required>
                        </div>
                        <div class="col">
                            <label>Expense Date</label>
                            <input type="text" name="expense_date" class="form-control form-control-air datePicker" required>
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


<!--Edit Modal-->

