<!--Create Modal-->
<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('bookings.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Bookings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <label>Guest Name</label>
                            <select name="guest_id" class="form-control form-control-air dd_select" style="width: 100%"
                                    required>
                                <option>Select Guest</option>
                                @foreach($guests as $guest)
                                    <option value="{{$guest->id}}">{{$guest->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Room</label>
                            <select name="room_id" class="form-control form-control-air dd_select" style="width: 100%"
                                    required>
                                <option value="">Select Room</option>
                                @foreach($rooms as $room)
                                    <option value="{{$room->id}}">{{$room->room_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Proposed Start Date</label>
                            <input type="text" name="proposed_start_date" class="form-control form-control-air datePicker"  required>
                        </div>
                        <div class="col">
                            <label>Proposed End Date</label>
                            <input type="text" name="proposed_end_date" class="form-control form-control-air datePicker"  required>
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


<!--Edit Modal-->

