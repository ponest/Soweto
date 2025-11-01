<!--Create Modal-->
<div class="modal fade" id="create_modal" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('conference-bookings.store')}}" method="post" autocomplete="off">
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
                            <select name="client_id" class="form-control form-control-air dd_select" style="width: 100%"
                                    required>
                                <option>Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <select name="conference_room_id" class="form-control form-control-air dd_select" style="width: 100%"
                                    required>
                                <option value="">Select Room</option>
                                @foreach($conference_rooms as $conference_room)
                                    <option value="{{$conference_room->id}}">{{$conference_room->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="start_date" class="form-control form-control-air" placeholder="Start Date">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="end_date" class="form-control form-control-air" placeholder="End Date">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="number_of_people" class="form-control form-control-air" placeholder="No of People">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="discount_percentage" class="form-control form-control-air" placeholder="Discount Percentage">
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

