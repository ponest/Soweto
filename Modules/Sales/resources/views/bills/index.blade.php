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
                            <td style="width: 15%; text-align: right">{{$item->issuer->full_name}}</td>
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
