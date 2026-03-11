@extends('layouts.master')
@section('title','Payment History')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <!-- Top Card for Search -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="font-strong mb-0">Search Payments</h5>
                </div>
                <div class="card-body">
                    <form autocomplete="off" method="get" action="{{route('payment-history-filter')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <select name="payment_method_id" class="form-control form-control-air">
                                    <option value="">Payment Method</option>
                                    @foreach($payment_methods as $payment_method)
                                        <option value="{{$payment_method->id}}">
                                            {{$payment_method->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <select name="bill_source" class="form-control form-control-air">
                                    <option value="">Bill Sources</option>
                                    @foreach($bill_sources as $source)
                                        <option value="{{$source}}">{{$source}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <input type="text"
                                       class="form-control form-control-air datePicker"
                                       name="start_date"
                                       placeholder="Start Date">
                            </div>

                            <div class="col-md-3 mb-3">
                                <input type="text"
                                       class="form-control form-control-air datePicker"
                                       name="end_date"
                                       placeholder="End Date">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                                @if($is_post_back)
                                    <a href="{{route('payment-history-excel')}}" class="btn btn-primary">
                                        Export Excel
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Payment History Section -->
            <div class="row">
                <div class="col-12">
                    <h5 class="font-strong mb-3">{{$header}}</h5>

                    <hr class="mt-3 mb-4"/>
                    <div class="clearfix"></div>

                    @include('layouts.table_header')

                    <div class="table-responsive row">
                        <table class="table table-bordered table-hover table-sm" id="datatable">
                            <thead class="thead-default thead-lg">
                            <tr>
                                <th>S/N</th>
                                <th>Bill Ref No</th>
                                <th>Payment Reference</th>
                                <th>Confirmed By</th>
                                <th>Confirmed At</th>
                                <th>Payment Method</th>
                                <th>Paid Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td class="desc_name">{{$item->bill?->reference_no}}</td>
                                    <td style="width: 15%; text-align: right">{{$item->payment_reference}}</td>
                                    <td style="width: 15%;">{{$item->confirmedBy?->full_name}}</td>
                                    <td style="width: 15%;">{{date('d M Y H:i', strtotime($item->payment_confirmed_at))}}</td>
                                    <td style="width: 15%">{{$item->paymentMethod?->name}}</td>
                                    <td style="width: 15%; text-align: right">{{number_format($item->paid_amount)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            @if($is_post_back)
                                <tfoot>
                                <tr style="font-weight: bold; background: whitesmoke">
                                    <td></td>
                                    <td colspan="5">Total</td>
                                    <td style="text-align: right">{{number_format($total_price)}}</td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        datePickerLoad()
    </script>
@endsection
