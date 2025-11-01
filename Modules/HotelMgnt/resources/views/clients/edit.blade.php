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
                <input type="text" name="name" class="form-control form-control-air"
                     value="{{$item->name}}"  placeholder="Full Name">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <select  name="institution_id" class="form-control form-control-air" required>
                    <option value="">Institutions</option>
                    @foreach($institutions as $institution)
                        <option value="{{$institution->id}}" {{$institution->id == $item->isntitution_id ? 'selected':''}}>{{$institution->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="email" name="email" value="{{$item->email}}" class="form-control form-control-air" placeholder="Email">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="tel" name="phone_number" value="{{$item->phone_number}}" class="form-control form-control-air" placeholder="Phone Number">
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
