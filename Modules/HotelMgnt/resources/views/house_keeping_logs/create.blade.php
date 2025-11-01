<div class="modal fade" id="create_modal" tabindex="-1" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('house-kp-logs.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create House Keeping Log</h5>
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
                                    <option value="{{$room->id}}">{{$room->room_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select name="staff_id" class="form-control form-control-air" required>
                                <option value="">Select Staff</option>
                                @foreach($staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="cleaned_on" class="form-control form-control-air datePicker" placeholder="Cleaned Date" required>
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
