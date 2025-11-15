<form action="{{route('clients.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="row mb-3">
            <div class="col">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control form-control-air"
                       value="{{$item->full_name}}"  required>
            </div>
            <div class="col">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control form-control-air"
                       value="{{$item->phone_number}}"  required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-air"
                       value="{{$item->email}}" placeholder="Email">
            </div>
            <div class="col">
                <label>Gender</label>
                <select type="email" name="gender" class="form-control form-control-air" required>
                    <option>Select Gender</option>
                    @foreach($genders as $gender)
                        <option value="{{$gender}}" {{$gender == $item->gender ? 'selected':''}}>{{$gender}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Id Type</label>
                <select name="identity_type_id" class="form-control form-control-air">
                    <option value="">Select ID Type</option>
                    @foreach($id_types as $id_type)
                        <option value="{{$id_type->id}}" {{$id_type->id == $item->identity_type_id ?'selected':''}}>{{$id_type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Identity Number</label>
                <input type="text" name="identity_number" class="form-control form-control-air"
                       value="{{$item->identity_number}}"   placeholder="ID Number">
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
