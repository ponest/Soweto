<form action="{{route('item-price-approval.reject')}}" method="post" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Reject Price Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="{{$id}}">
        <div class="row mb-3">
            <div class="col">
                <textarea name="reject_comments" class="form-control form-control-air" placeholder="Reject Comments" required></textarea>
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
