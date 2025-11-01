@extends('layouts.master')
@section('title','Item Stock In')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">ITEM STOCK IN</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    @can('StoreOfficer')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_modal">
                        <i class="fa fa-plus-circle"></i> Add New
                    </button>
                    @endcan
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
                        @can('StoreOfficer')
                            <th>Supplier</th>
                        @endcan
                        <th>Item</th>
                        <th>Quantity</th>
                        @can('StoreOfficer')
                            <th>Bulk Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        @endcan
                        <th>Received Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            @can('StoreOfficer')
                                <td>{{isset($item->supplier) ? $item->supplier->name:'Not Defined'}}</td>
                            @endcan
                            <td class="desc_name">{{isset($item->item) ? $item->item->name:'Not Defined'}}</td>
                            <td>{{isset($item->unit) ? $item->quantity." ".$item->unit->name :''}}</td>
                            @can('StoreOfficer')
                                <td>{{isset($item->bulkUnit) ? $item->bulk_quantity." ".$item->bulkUnit->name :''}}</td>
                                <td>{{number_format($item->unit_price)}}</td>
                                <td>{{number_format($item->total_price)}}</td>
                            @endcan
                            <td>{{$item->received_date}}</td>
                            <td style="width: 9%" class="text-center">
                                <a class="text-muted font-16 edit-link" href="{{route('item-stock-in.edit',$item->id)}}"
                                   title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> |
                                <a class="text-muted font-16 delete-link"
                                   href="{{route('item-stock-in.destroy',$item->id)}}"
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
    @include('inventory::item_stock_in.create')

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

        datePickerLoad();

        $("#unit_price").on('keyup', function () {
            const unitPrice = $(this).val();
            const quantity = $("#quantity").val();
            const totalPrice = parseFloat(unitPrice) * parseFloat(quantity);
            $("#total_price").val(totalPrice);
        });

        $('#edit_modal').on('shown.bs.modal', function () {
            $("#e_unit_price").on('keyup', function () {
                const unitPrice = $(this).val();
                const quantity = $("#e_quantity").val();
                const totalPrice = parseFloat(unitPrice) * parseFloat(quantity);
                $("#e_total_price").val(totalPrice);
            })
        });

    </script>
@endsection
