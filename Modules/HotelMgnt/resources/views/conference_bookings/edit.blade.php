<form action="{{route('bookings.store')}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Bookings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">

        <div class="row mb-3">
            <div class="col">
                <select name="guest_id" class="form-control form-control-air" id="guest_id" required>
                    <option>Select Guest</option>
                    @foreach($guests as $guest)
                        <option value="{{$guest->id}}" {{$guest->id == $item->guest_id ? 'selected':''}}>{{$guest->full_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <select name="room_id" class="form-control form-control-air">
                    <option value="">Select Room</option>
                    @foreach($rooms as $room)
                        <option value="{{$room->id}}" {{$room->id == $item->room_id ? 'selected':''}}>{{$room->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" value="{{$item->check_in_date ? 'selected':''}}" name="check_in_date"
                       class="form-control form-control-air" placeholder="Check In Date">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" value="{{$item->check_out_date}}" name="check_out_date" class="form-control form-control-air" placeholder="Check Out Date">
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
