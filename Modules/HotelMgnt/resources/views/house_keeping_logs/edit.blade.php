<form action="{{route('house-kp-logs.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit House Keeping Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <select name="room_id" class="form-control form-control-air" required>
                    <option value="">Select Room</option>
                    @foreach($rooms as $room)
                        <option value="{{$room->id}}" {{$room->id == $item->room_id ? 'selected':''}}>{{$room->room_number}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select name="staff_id" class="form-control form-control-air" required>
                    <option value="">Select Staff</option>
                    @foreach($staffs as $staff)
                        <option value="{{$staff->id}}" {{$staff->id == $item->staff_id ? 'selected':''}}>{{$staff->full_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" value="{{$item->cleaned_on}}" name="cleaned_on" class="form-control form-control-air datePicker" placeholder="Cleaned Date" required>
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
