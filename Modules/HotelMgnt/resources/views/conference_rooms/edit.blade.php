<form action="{{route('conference-rooms.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Conference Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" value="{{$item->name}}" class="form-control form-control-air" placeholder="Name">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="capacity" value="{{$item->capacity}}" class="form-control form-control-air" placeholder="Capacity">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="rate_per_person" value="{{$item->rate_per_person}}" class="form-control form-control-air" placeholder="Rate Per Person">
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
