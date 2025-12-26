@extends('layouts.master')
@section('title','Advance Payment')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">ADVANCE PAYMENT</h5>
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
                        <th>Reference Number</th>
                        <th>Client</th>
                        <th>Booking Ref No</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td>{{$item->reference_number}}</td>
                            <td class="desc_name">{{$item->client?->full_name}}</td>
                            <td>{{$item->booking?->reference_number}}</td>
                            <td>{{$item->paymentMethod?->name}}</td>
                            <td style="text-align: right">{{number_format($item->amount)}}</td>
                            <td>{{$item->creator?->full_name}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$item->is_used)
                                    <a class="text-muted font-16 edit-link" href="{{route('advance-payment.edit',$item->id)}}"
                                       title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> |
                                    <a class="text-muted font-16 delete-link" href="{{route('advance-payment.destroy',$item->id)}}"
                                       title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
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
    @include('hotelmgnt::advance_payment.create')

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

        $('#booking_id').on('change', function (e) {
            const selected = $(this).find(':selected');
            const clientId = selected.data('client');
            alert(clientId);
            $('#client_id').val(clientId);
        })

        //For Deleting
        $(".delete-link").click(function (e) {
            e.preventDefault();
            const Description = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(Description, Url);
        });

    </script>
@endsection
