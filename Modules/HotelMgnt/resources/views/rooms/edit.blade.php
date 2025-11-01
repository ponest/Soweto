<form action="{{route('rooms.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <select type="text" name="room_type_id" class="form-control form-control-air"
                        placeholder="Room Type Name" required>
                    <option value="">Select Room Type</option>
                    @foreach($room_types as $room_type)
                        <option value="{{$room_type->id}}" {{$room_type->id == $item->room_type_id ? 'selected':''}}>{{$room_type->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="room_number" class="form-control form-control-air"
                    value="{{$item->room_number}}"  placeholder="Enter Room Number" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="number" name="rate_per_night" class="form-control form-control-air"
                    value="{{$item->rate_per_night}}"   placeholder="Enter Rate Per Night" required>
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
