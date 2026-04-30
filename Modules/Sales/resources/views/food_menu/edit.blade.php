<form action="{{route('food-menu.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Food Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <label>Menu Name</label>
                <input type="text" name="name" class="form-control form-control-air"
                     value="{{$item->name}}"  required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Has Company</label>
                <select name="has_company" class="form-control form-control-air" required>
                    <option value="">--Select--</option>
                    @foreach($has_company as ['value'=> $value,'text'=> $text])
                        <option value="{{$value}}" {{$value == $item->has_company ? 'selected':''}}>{{$text}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Is Company</label>
                <select name="is_company" class="form-control form-control-air" required>
                    <option value="">---Select---</option>
                    @foreach($is_company as ['value'=> $value,'text'=> $text])
                        <option value="{{$value}}" {{$value == $item->is_company ? 'selected':''}}>{{$text}}</option>
                    @endforeach()
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
