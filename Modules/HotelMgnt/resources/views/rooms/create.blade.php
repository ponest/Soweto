<div class="modal fade" id="create_modal" tabindex="-1" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('rooms.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col form-group">
                            <select type="text" name="room_type_id" class="form-control form-control-air dd_select" required style="width: 100%" >
                                <option value="">Select Room Type</option>
                                @foreach($room_types as $room_type)
                                    <option value="{{$room_type->id}}">{{$room_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="room_number" class="form-control form-control-air"
                                   placeholder="Enter Room Number" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" name="rate_per_night" class="form-control form-control-air"
                                   placeholder="Enter Rate Per Night" required>
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
