<!--Create Modal-->
<div class="modal fade" id="create_modal"  aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('users.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Create Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control form-control-air" required>
                        </div>
                        <div class="col">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control form-control-air" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-air" required>
                        </div>
                        <div class="col">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" name="phone_number" class="form-control form-control-air" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="department_id">Department</label>
                            <select  name="department_id" class="form-control form-control-air dd_select" style="width: 100%" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="store_id">Assigned Store</label>
                            <select  name="store_id" class="form-control form-control-air dd_select" style="width: 100%">
                                <option value="">Select Store</option>
                                @foreach($stores as $item_store)
                                    <option value="{{$item_store->id}}">{{$item_store->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="roles">Role</label>
                            <select id="roles" name="roles[]" class="form-control form-control-air dd_select" style="width: 100%" multiple required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
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

