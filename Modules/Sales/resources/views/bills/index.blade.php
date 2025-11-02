@extends('layouts.master')
@section('title','Bills')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">BILLS</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <!--Buttons Goes Here-->
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
                        <th>Reference No</th>
                        <th>Origin</th>
                        <th>Bill Amount</th>
                        <th>Status</th>
                        <th>Issued At</th>
                        <th>Issued By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->reference_no}}</td>
                            <td style="width: 15%; text-align: right">{{$item->category}}</td>
                            <td style="width: 15%; text-align: right">{{number_format($item->bill_amount)}}</td>
                            <td style="width: 15%; text-align: right">{{$item->status}}</td>
                            <td style="width: 15%;">{{date('d M Y H:i', strtotime($item->issued_at))}}</td>
                            <td style="width: 15%; text-align: right">{{$item->issuer?->full_name}}</td>
                            <td style="width: 9%" class="text-center">
                                @if($item->status != 'Paid')
                                    <a class="text-muted font-16 conf-payment-link" href="{{route('bills.payment-conf',$item->id)}}"
                                       title="Confirm Payment" data-toggle="tooltip"><i class="fa fa-edit"></i></a> |
                                @endif
                                <a class="text-muted font-16 payment" href="{{route('bills.payment',$item->id)}}"
                                   title="Payment" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="conf_payment_modal" aria-labelledby="conf_payment_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-payment-conf">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment_modal" aria-labelledby="payment_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-payment">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        $('.conf-payment-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-payment-conf').load(dataURL, function () {
                $('#conf_payment_modal').modal({show: true});
            });
        });

        $('.payment').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-payment').load(dataURL, function () {
                $('#payment_modal').modal({show: true});
            });
        });

        $("#conf_payment_modal").on('shown.bs.modal', function (e) {
            $('select').select2({
                width: '100%'
            });
        })
    </script>
@endsection
