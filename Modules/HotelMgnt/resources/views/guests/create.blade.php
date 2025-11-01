<!--Create Modal-->
<div class="modal fade" id="create_modal" tabindex="-1" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('guests.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Guests</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="full_name" class="form-control form-control-air"
                                   placeholder="Full Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="phone_number" class="form-control form-control-air"
                                   placeholder="Phone Number" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="email" name="email" class="form-control form-control-air"
                                   placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select type="email" name="gender" class="form-control form-control-air" required>
                                <option>Select Gender</option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender}}">{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select name="identity_type_id" class="form-control form-control-air">
                                <option value="">Select ID Type</option>
                                @foreach($id_types as $id_type)
                                    <option value="{{$id_type->id}}">{{$id_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="identity_number" class="form-control form-control-air"
                                   placeholder="ID Number">
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

