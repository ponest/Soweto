@extends('layouts.master')
@section('title','Booking Charges')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">BOOKING CHARGES</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <a href="{{route('room-checkinout')}}" class="btn btn-primary" >
                        <i class="fa fa-backward"></i> Go Back
                    </a>
                    @if($bill && $bill->status == 'unpaid')
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
                        <th>Type</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Expense Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->type}}</td>
                            <td>{{$item->description}}</td>
                            <td style="text-align: right">{{number_format($item->unit_price)}}</td>
                            <td style="text-align: right">{{number_format($item->quantity)}}</td>
                            <td style="text-align: right">{{number_format($item->total_price)}}</td>
                            <td>{{date('d M Y', strtotime($item->expense_date))}}</td>
                            <td style="width: 9%" class="text-center">
                                @if($item->can_modify && $bill && $bill->status == 'unpaid')
                                    <a class="text-muted font-16 edit-link" href="{{route('booking-charges.edit',$item->id)}}"
                                       title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> |
                                    <a class="text-muted font-16 delete-link"
                                       href="{{route('booking-charges.destroy',$item->id)}}"
                                       title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
                                @else
                                    <span>No Action</span>
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
    @include('hotelmgnt::booking_charges.create')

    <div class="modal fade" id="edit_modal" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-edit">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancel_modal" aria-labelledby="cancel_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-cancel">
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

        $('#edit_modal').on('shown.bs.modal', function (e) {
            datePickerLoad();
        });

        $("#quantity").on('keyup', function (e) {
            const quantity = $("#quantity").val();
            const unitPrice = $("#unit_price").val();
            const totalPrice = quantity * unitPrice;
            console.log("Quantity",quantity);
            console.log("Unit Price",unitPrice);
            console.log("Total Price",totalPrice);
            $("#total_price").val(totalPrice);
        })

        //For Deleting
        $(".delete-link").click(function (e) {
            e.preventDefault();
            const Description = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(Description, Url);
        });

        datePickerLoad();

    </script>
@endsection
