<form action="{{route('units.update',$item->id)}}" method="post" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Edit Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control form-control-air"
                     value="{{$item->name}}"  placeholder="Unit Name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="symbol" class="form-control form-control-air"
                       value="{{$item->symbol}}"  placeholder="Abbreviation" required>
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
