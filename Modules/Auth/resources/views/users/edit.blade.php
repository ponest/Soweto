<form action="{{route('users.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="row mb-3">
            <div class="col">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control form-control-air"
                     value="{{$item->first_name}}"  required>
            </div>
            <div class="col">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control form-control-air"
                     value="{{$item->last_name}}"  required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-air"
                     value="{{$item->email}}"  required>
            </div>
            <div class="col">
                <label>Phone Number</label>
                <input type="number" name="phone_number" class="form-control form-control-air"
                     value="{{$item->phone_number}}"  required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Department</label>
                <select  name="department_id" class="form-control form-control-air dd_select" style="width: 100%" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{$department->id}}" {{$department->id == $item->department_id ? 'selected':''}}>{{$department->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Assigned Store</label>
                <select  name="store_id" class="form-control form-control-air dd_select" style="width: 100%">
                    <option value="">Select Store</option>
                    @foreach($stores as $item_store)
                        <option value="{{$item_store->id}}" {{$item_store->id == $item->store_id ? 'selected':''}}>{{$item_store->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Role</label>
                <select  name="roles[]" class="form-control form-control-air dd_select" style="width: 100%" multiple required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{in_array($role->id, $selected_roles)? 'selected' : ''}}>{{$role->name}}</option>
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
