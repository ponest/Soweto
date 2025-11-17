<form action="{{route('bookings.update',$item->id)}}" method="post" autocomplete="off">
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
                <label>Client Name</label>
                <select name="client_id" class="form-control form-control-air dd_select" style="width: 100%" required>
                    <option>Select Client</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}" {{$client->id == $item->client_id ? 'selected':''}}>{{$client->full_name}}</option>
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
                        <option value="{{$room->id}}" {{$room->id == $item->room_id ? 'selected':''}}>{{$room->room_number}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col">
                <label>Proposed Start Date</label>
                <input type="text" name="proposed_start_date" value="{{$item->proposed_start_date}}" class="form-control form-control-air datePicker"  required>
            </div>
            <div class="col">
                <label>Proposed End Date</label>
                <input type="text" name="proposed_end_date" value="{{$item->proposed_end_date}}" class="form-control form-control-air datePicker"  required>
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
