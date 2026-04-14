@php use Modules\HotelMgnt\Models\RoomCheckInOut; @endphp
@extends('layouts.master')
@section('title','Rooms By Status')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">{{$header}}</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <!-- Buttons Goes Here-->
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
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Rate Per Night</th>
                        @if($status == "Occupied")
                            <th>Occupied By</th>
                        @endif
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td>{{$item->roomType->name}}</td>
                            <td class="desc_name">{{$item->room_number}}</td>
                            <td>{{number_format($item->rate_per_night)." TZS"}}</td>
                            @if($status == "Occupied")
                                <td>{{RoomCheckInOut::getClientByRoomId($item->id)}}</td>
                            @endif
                            <td>{{$item->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

