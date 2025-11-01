<form action="{{route('stock-items.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Stock Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <label>Item Name</label>
                <input type="text" name="name" value="{{$item->name}}" class="form-control form-control-air"  required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Item Category</label>
                <select  name="category_id" class="form-control form-control-air" required>
                    <option value="">Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $item->category_id ? 'selected':''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Smallest Unit</label>
                <select  name="unit_id" class="form-control form-control-air" required>
                    <option value="">Choose Smallest Unit</option>
                    @foreach($units as $unit)
                        <option value="{{$unit->id}}" {{$unit->id == $item->unit_id ? 'selected':''}}>{{$unit->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Bulk Unit</label>
                <select  name="bulk_unit_id" class="form-control form-control-air" required>
                    <option value="">Choose Bulk Unit</option>
                    @foreach($units as $unit)
                        <option value="{{$unit->id}}" {{$unit->id == $item->bulk_unit_id ? 'selected':''}}>{{$unit->name}}</option>
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
