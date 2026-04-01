<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('kitchen-trans-req.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Kitchen Transaction Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control form-control-air" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Date Consumed</label>
                            <input type="text" name="report_date" class="form-control form-control-air datePicker" required>
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
