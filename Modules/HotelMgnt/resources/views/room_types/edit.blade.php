<form action="{{route('room-types.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Room Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control form-control-air"
                     value="{{$item->name}}"  placeholder="Room Type Name" required>
            </div>
            <div class="col">
                <input type="number" name="capacity" class="form-control form-control-air"
                      value="{{$item->capacity}}" placeholder="Capacity" required>
            </div>
        </div> <div class="row mb-3">
            <div class="col">
                <textarea name="description" class="form-control form-control-air" placeholder="Description" required>{{$item->description}}</textarea>
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
