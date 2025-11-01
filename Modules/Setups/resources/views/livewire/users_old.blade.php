<div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-9" style="padding-top: 2vh">
                        <h5 class="font-strong">USERS</h5>
                    </div>
                    <div class="col-3" style="text-align: right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_modal">
                            <i class="fa fa-plus-circle"></i> Add New
                        </button>
                    </div>
                </div>
                <hr class="mt-3 mb-4"/>

                <div class="clearfix"></div>

                <div class="flexbox mb-4">
                    <div class="flexbox">
                        <label class="mb-0 mr-2">Type:</label>
                        <select class="selectpicker show-tick form-control" id="rows-per-page"
                                title="Select rows per page"
                                data-style="btn-solid" data-width="150px">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="input-group-icon input-group-icon-left mr-3">
                        <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text"
                               placeholder="Search ...">
                    </div>
                </div>
                <div class="table-responsive row">
                    <table class="table table-bordered table-hover table-sm" id="datatable">
                        <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th class="no-sort">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $key=>$item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>
                                    <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="create_modal" tabindex="-1" aria-labelledby="create_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create_modal">Create Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" wire:model="first_name" class="form-control form-control-air"
                                       placeholder="First name">
                            </div>
                            <div class="col">
                                <input type="text" wire:model="last_name" class="form-control form-control-air"
                                       placeholder="Last name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="email" wire:model="email" class="form-control form-control-air"
                                       placeholder="Email">
                            </div>
                            <div class="col">
                                <input type="number" wire:model="phone_number" class="form-control form-control-air"
                                       placeholder="Phone Number">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('datatable')@endsection
</div>


