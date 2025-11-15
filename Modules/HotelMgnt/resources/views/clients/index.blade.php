@extends('layouts.master')
@section('title','Clients')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">CLIENTS/GUESTS</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_modal">
                        <i class="fa fa-plus-circle"></i> Add New
                    </button>
                </div>
            </div>

            <hr class="mt-3 mb-4"/>
            <div class="clearfix"></div>

            @include('layouts.table_header')

            <div class="table-responsive row">
                <table class="table table-bordered table-hover table-sm" id="datatable">
                    <thead class="thead-default thead-lg">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>ID Type</th>
                        <th>ID Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td class="desc_name">{{$item->full_name}}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{isset($item->identityType) ? $item->identityType->name : ''}}</td>
                            <td>{{$item->identity_number}}</td>
                            <td style="width: 9%" class="text-center">
                                <a class="text-muted font-16 edit-link" href="{{route('clients.edit',$item->id)}}"
                                   title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> |
                                <a class="text-muted font-16 delete-link" href="{{route('clients.destroy',$item->id)}}"
                                   title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!--Create Modal && Edit Modal -->
    @include('hotelmgnt::clients.create')

    <div class="modal fade" id="edit_modal" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-edit">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        $('.edit-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-edit').load(dataURL, function () {
                $('#edit_modal').modal({show: true});
            });
        });

        //For Deleting Zones
        $(".delete-link").click(function (e) {
            e.preventDefault();
            const Description = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(Description, Url);
        });

        $('#edit_modal').on('shown.bs.modal', function () {
            $('.dd_select').select2();
        });
    </script>
@endsection
