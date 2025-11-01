<!--Create Modal-->
<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('room-check-in')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Check In Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label>Choose Booking</label>
                            <select name="booking_id" class="form-control form-control-air dd_select" style="width: 100%" required>
                                <option>Select Booking Reference</option>
                                @foreach($bookings as $booking)
                                    <option value="{{$booking->id}}">{{$booking->reference_number}}</option>
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
        </div>
    </div>
</div>


<!--Edit Modal-->

