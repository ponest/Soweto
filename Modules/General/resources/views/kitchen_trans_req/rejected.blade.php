@extends('layouts.master')
@section('title','Rejected Kitchen Trans Req')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">REJECTED KITCHEN REQUEST</h5>
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
                        <th>Request Number</th>
                        <th>Description</th>
                        <th>Rejected By</th>
                        <th>Rejected At</th>
                        <th>Comments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->request_number}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->reviewedBy?->full_name}}</td>
                            <td>{{isset($item->reviewed_at) ? date('d M Y H:i',strtotime($item->reviewed_at)) : 'N/A'}}</td>
                            <td>{{$item->reject_comments}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

