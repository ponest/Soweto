<form action="{{route('staffs.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Staffs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <input type="text" value="{{$item->first_name}}" name="first_name" class="form-control form-control-air" placeholder="First Name" required>
            </div>
            <div class="col">
                <input type="text" value="{{$item->first_name}}" name="last_name" class="form-control form-control-air" placeholder="Last Name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select type="text" name="gender" class="form-control form-control-air" required>
                    <option value="">--Select Gender---</option>
                    @foreach($gender as $gnd)
                        <option value="{{$gnd}}" {{$gnd == $item->gender ? 'selected':''}}>{{$gnd}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="phone_number" value="{{$item->phone_number}}" class="form-control form-control-air" placeholder="Phone Number" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select type="text" name="staff_role_id" class="form-control form-control-air" required>
                    <option value="">--Select Role---</option>
                    @foreach($staff_roles as $staff_role)
                        <option value="{{$staff_role->id}}" {{$staff_role->id == $item->staff_role_id ? 'selected':''}}>{{$staff_role->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="physical_address" value="{{$item->physical_address}}" class="form-control form-control-air" placeholder="Physical Address" required>
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
