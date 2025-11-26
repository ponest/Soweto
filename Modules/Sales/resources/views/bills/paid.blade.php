@extends('layouts.master')
@section('title','Paid Bills')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">PAID BILLS</h5>
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
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td>{{$item->reference_no}}</td>
                            <td style="width: 15%; text-align: right">{{$item->category}}</td>
                            <td style="width: 15%; text-align: right">{{number_format($item->bill_amount)}}</td>
                            <td style="width: 15%;">{{date('d M Y H:i', strtotime($item->issued_at))}}</td>
                            <td style="width: 9%" class="text-center">
                                <a class="text-muted font-16 bill-items" href="{{route('bills.items',$item->id)}}"
                                   title="Bill Items" data-toggle="tooltip"><i class="fa fa-money"></i></a>
                                | <a class="text-muted font-16 payment" href="{{route('bills.payment',$item->id)}}"
                                     title="Payment" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('sales::bills.payment_det_modal')
    @include('sales::bills.bill_items_modal')
@endsection

@section('Scripts')
    <script>

        $('.payment').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-payment').load(dataURL, function () {
                $('#payment_modal').modal({show: true});
            });
        });

        $('.bill-items').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-bill-items').load(dataURL, function () {
                $('#bill_items_modal').modal({show: true});
            });
        });

    </script>
@endsection

