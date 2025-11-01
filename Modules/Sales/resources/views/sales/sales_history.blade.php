@extends('layouts.master')
@section('title','Sales History')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">SALES HISTORY</h5>
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
                </table>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        // JavaScript Goes here
    </script>
@endsection
