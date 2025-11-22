@extends('layouts.master')
@section('title','Purchase Request')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">STOCK PURCHASE REQUEST</h5>
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
                        <th>S/N</th>
                        <th>Request No</th>
                        <th>Description</th>
                        <th>Submitted By</th>
                        <th>Submitted At</th>
                        <th>Status</th>
                        <th>Reject Comments</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->request_number}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{isset($item->submittedBy) ? $item->submittedBy->full_name:'Not Submitted'}}</td>
                            <td>{{isset($item->submitted_at) ? date('d M Y H:i',strtotime($item->submitted_at)) : 'N/A'}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->reject_comments}}</td>
                            <td style="width: 12%" class="text-center">
                                @if(!$item->submitted_at)
                                    <a class="text-muted font-16 edit-link"
                                       href="{{route('purchase-request.edit',$item->id)}}"
                                       title="Edit" data-toggle="tooltip"><i class="fa fx-2 fa-edit"></i></a> |
                                    <a class="text-muted font-16 delete-link"
                                       href="{{route('purchase-request.destroy',$item->id)}}"
                                       title="Delete" data-toggle="tooltip"><i class="fa fx-2 fa-trash-o"></i></a> |
                                @endif
                                <a class="text-muted font-16"
                                   href="{{route('purchase-request-item.index',$item->id)}}"
                                   title="Items" data-toggle="tooltip"><i class="fa fx-2 fa-arrow-circle-o-right"></i></a>
                                   | <a class="text-muted font-16"
                                       href="{{route('purchase-req-cost',$item->id)}}"
                                       title="Additional Cost" data-toggle="tooltip"><i class="fa fx-2 fa-money"></i></a>
                                @if(!$item->submitted_at)
                                    | <a class="text-muted font-16 submit-link"
                                         href="{{route('purchase-request.submit',$item->id)}}"
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

    <!--Create Modal && Edit Modal -->
    @include('inventory::purchase_request.create')

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

        //For Deleting
        $(".delete-link").click(function (e) {
            e.preventDefault();
            const Description = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(Description, Url);
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
