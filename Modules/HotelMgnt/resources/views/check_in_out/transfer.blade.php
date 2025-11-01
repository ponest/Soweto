<form action="{{route('room.transfer')}}" method="post" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Transfer Room Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <input type="hidden" value="{{$item->booking_id}}" name="booking_id">
        <input type="hidden" value="{{$item->id}}" name="id">
        <div class="row mb-3">
            <div class="col">
                <label>Transfer Reasons</label>
                <textarea name="remarks" class="form-control form-control-air" required></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>New Room</label>
                <select name="new_room_id" class="form-control form-control-air" required>
                    <option value="">---select---</option>
                    @foreach($rooms as $room)
                        <option value="{{$room->id}}">{{$room->room_number}}</option>
                    @endforeach
                </select>
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
