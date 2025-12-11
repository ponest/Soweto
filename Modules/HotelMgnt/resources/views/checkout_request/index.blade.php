@extends('layouts.master')
@section('title','Checkout Request')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">CHECKOUT REQUESTS</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <!-- Buttons Goes Here-->
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
                        <th>Request Number</th>
                        <th>Client Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td class="desc_name">{{$item->request_number}}</td>
                            <td>{{$item->booking?->client?->full_name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->status}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$item->submitted_at)
                                    <a class="text-muted font-16 edit-link" href="{{route('checkout-req.edit',$item->id)}}"
                                       title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> |
                                    <a class="text-muted font-16 delete-link" href="{{route('checkout-req.destroy',$item->id)}}"
                                       title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
                                    | <a class="text-muted font-16 submit-link"
                                         href="{{route('checkout-req.submit',$item->id)}}"
                                         title="Submit" data-toggle="tooltip"><i class="fa fx-2 fa-check-circle-o"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade" id="edit_modal" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog">
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

        //For Check In
        $(".submit-link").click(function (e) {
            e.preventDefault();
            const Description = "Requisition " + $(this).closest('tr').children('td.desc_name').text().trim() + " Will be Submitted";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Submit';
            actionConfirm(Description, Url, ButtonText);
        });
    </script>
@endsection
