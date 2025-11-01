<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('conference-rooms.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Conference Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="name" class="form-control form-control-air" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" name="capacity" class="form-control form-control-air" placeholder="Capacity" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" name="rate_per_person" class="form-control form-control-air" placeholder="Rate Per Person" required>
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
