<form action="{{route('suppliers.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" value="{{$item->name}}" class="form-control form-control-air" placeholder="Supplier Name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="email" name="email" value="{{$item->email}}" class="form-control form-control-air" placeholder="Email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="phone_number" value="{{$item->phone_number}}" class="form-control form-control-air" placeholder="Phone Number" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" name="postal_address" value="{{$item->postal_address}}" class="form-control form-control-air" placeholder="Postal Address" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" name="location" value="{{$item->location}}" class="form-control form-control-air" placeholder="Physical Location" required>
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
