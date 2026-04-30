@php use Modules\HotelMgnt\Models\RoomCheckInOut; @endphp
@extends('layouts.master')
@section('title','Check In Out Status')
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
                        <th>Booking Reference</th>
                        <th>Client Name</th>
                        <th>Room Number</th>
                        @if($type == 'Check-In')
                            <th>Checked In At</th>
                            <th>Check In By</th>
                        @else
                            <th>Checked Out</th>
                            <th>Checked Out By</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td class="desc_name">{{$item->booking?->reference_number}}</td>
                            <td>{{$item->booking?->client?->full_name}}</td>
                            <td style="text-align: right">{{$item->room?->room_number}}</td>
                            @if($type == 'Check-In')
                                <td>{{date('d M Y H:i', strtotime($item->checked_in_at))}}</td>
                                <td>{{$item->checkedInBy?->full_name}}</td>
                            @else
                                <td>{{$item->checked_out_at != null ? date('d M Y H:i', strtotime($item->checked_out_at)):'---'}}</td>
                                <td>{{$item->checkedOutBy?->full_name}}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

