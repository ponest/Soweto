@php use Modules\Inventory\Models\StockItem; @endphp
@extends('layouts.master')
@section('title','Kitchen Transaction Request Items')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-8" style="padding-top: 2vh">
                    <h5 class="font-strong">{{$requisition->request_number}} - KITCHEN TRANSACTION REQUEST ITEMS</h5>
                </div>
                <div class="col-4" style="text-align: right">
                    <a href="{{route('kitchen-trans-req.index')}}" class="btn btn-primary">
                        <i class="fa fa-backward"></i> Go Back
                    </a>
                    @if(!$requisition->submitted_at)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_modal">
                            <i class="fa fa-plus-circle"></i> Add New
                        </button>
                    @endif
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
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{isset($item->stockItem) ? $item->stockItem->name:'Not Defined'}}</td>
                            <td style="text-align: right; width: 15%">{{number_format($item->quantity)." ".$item->unit?->name}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$requisition->submitted_at)
                                    <a class="text-muted font-16 delete-link"
                                       href="{{route('kitchen-trans-item.destroy',$item->id)}}"
                                       title="Delete" data-toggle="tooltip"><i class="fa fx-2 fa-trash-o"></i></a>
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
    @include('general::kitchen_trans_req_item.create')

    <!--Confirm Item Modal-->
    <div class="modal fade" id="confirm_modal" aria-labelledby="confirm_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-confirm">
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

        $("#edit_modal").on('shown.bs.modal', function () {
            $('#e_stock_item_id').on('change', function () {
                const itemId = $(this).val();
                const unitRef = $("#e_unit_name");
                const unitIdRef = $("#e_unit_id");
                getUnit(itemId, unitRef, unitIdRef);
            });
        });

        $('.confirm-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-confirm').load(dataURL, function () {
                $('#confirm_modal').modal({show: true});
            });
        });

        //For Deleting
        $(".delete-link").click(function (e) {
            e.preventDefault();
            const Description = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(Description, Url);
        });

        $('#stock_item_id').on('change', function () {
            const itemId = $(this).val();
            const unitRef = $("#unit_name");
            const unitIdRef = $("#unit_id");
            getUnit(itemId, unitRef, unitIdRef);
        });

    </script>
@endsection
