@extends('layouts.master')
@section('title','Sales History')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-5" style="padding-top: 2vh">
                    <h5 class="font-strong">SALES HISTORY</h5>
                </div>
                <div class="col-7" style="text-align: right">
                    <!--Buttons Goes Here-->
                    <form autocomplete="off" method="post" action="{{route('sales-history-filter')}}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control form-control-air datePicker" name="start_date" placeholder="Start Date">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-air datePicker" name="end_date" placeholder="End Date">
                            </div>
                            <div class="col-4" style="text-align: left">
                                <button type="submit" class="btn btn-primary">Search</button>
                                @if($is_post_back)
                                    <a href="{{route('sales-history-excel')}}"  class="btn btn-primary">Excel</a>
                                @endif
                            </div>
                        </div>
                    </form>
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
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Sold At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->item_name}}</td>
                            <td style="width: 15%; text-align: right">{{number_format($item->unit_price)}}</td>
                            <td style="width: 15%; text-align: right">{{$item->quantity}}</td>
                            <td style="width: 15%; text-align: right">{{number_format($item->total_price)}}</td>
                            <td style="width: 15%;">{{date('d M Y H:i', strtotime($item->created_at))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    @if($is_post_back)
                        <tfoot>
                        <tr style="font-weight: bold; background: whitesmoke">
                            <td></td>
                            <td colspan="3">Total</td>
                            <td style="text-align: right">{{number_format($total_price)}}</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        datePickerLoad()
    </script>
@endsection
