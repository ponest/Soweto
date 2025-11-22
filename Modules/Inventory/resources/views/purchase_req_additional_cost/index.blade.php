@php use Modules\Inventory\Models\StockItem; @endphp
@extends('layouts.master')
@section('title','Purchase Req Additional Cost')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-8" style="padding-top: 2vh">
                    <h5 class="font-strong">{{$requisition->request_number}} - ADDITIONAL COST</h5>
                </div>
                <div class="col-4" style="text-align: right">
                    <a href="{{route('purchase-request.index')}}" class="btn btn-primary">
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
                        <th>Cost Item</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->cost_item}}</td>
                            <td style="text-align: right">{{number_format($item->amount)}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$requisition->submitted_at)
                                    <a class="text-muted font-16 edit-link"
                                       href="{{route('purchase-req-cost.edit',$item->id)}}"
                                       title="Edit" data-toggle="tooltip"><i class="fa fx-2 fa-edit"></i></a> |
                                    <a class="text-muted font-16 delete-link"
                                       href="{{route('purchase-req-cost.destroy',$item->id)}}"
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
    @include('inventory::purchase_req_additional_cost.create')

    <!--Edit Modal-->
    <div class="modal fade" id="edit_modal" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-edit">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>

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

        $('#unit_price').on('keyup', function () {
            const unitPrice = parseFloat($(this).val());
            const quantity = parseFloat($("#quantity").val());
            const total = unitPrice * quantity;
            $('#total_price').val(total);
        });

        $("#edit_modal").on('shown.bs.modal', function () {
            $('#e_stock_item_id').on('change', function () {
                const itemId = $(this).val();
                const unitRef = $("#e_unit_name");
                const unitIdRef = $("#e_unit_id");
                getUnit(itemId, unitRef, unitIdRef);
            });

            $('#e_unit_price').on('keyup', function () {
                const unitPrice = parseFloat($(this).val());
                const quantity = parseFloat($("#e_quantity").val());
                const total = unitPrice * quantity;
                $('#e_total_price').val(total);
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

        $("#issue_stock").click(function (e) {
            e.preventDefault();
            const Description = "All the Requisition Items will be Issued";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Issue';
            actionConfirm(Description, Url, ButtonText);
        });

    </script>
@endsection
