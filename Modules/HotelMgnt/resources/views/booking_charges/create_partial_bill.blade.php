<form action="{{route('print-partial-bill')}}" method="post" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="create_modal">Create Partial Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <input type="hidden" value="{{$client_name}}" name="client_name">
        <div class="row mb-3">
            <div class="col">
                <label>Waiter</label>
                <select name="waiter_name" class="form-control form-control-air"  required>
                    <option value="">Select Waiter</option>
                    @foreach($waiters as $waiter)
                        <option value="{{$waiter->full_name}}">{{$waiter->full_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Bill Item</label>
                <select name="items[]" class="form-control form-control-air" multiple required>
                    <option value="">Select Items</option>
                    @foreach($items as $item)
                        <option value="{{$item->id}}">{{$item->description}}</option>
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
