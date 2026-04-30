@extends('layouts.master')
@section('title','Room Daily Status')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <!-- Top Card for Search -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="font-strong mb-0">Search Room Status</h5>
                </div>
                <div class="card-body">
                    <form autocomplete="off" method="post" action="{{route('daily-room-status')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <input type="text"
                                       class="form-control form-control-air datePicker"
                                       name="date"
                                       placeholder="Date">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                                @if($is_post_back)
                                    <a href="{{route('daily-room-status-excel')}}" class="btn btn-primary">
                                        Export Excel
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if($is_post_back)
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
                                    <th>Room #</th>
                                    <th>Room Type</th>
                                    <th>Rate</th>
                                    <th>Guest</th>
                                    <th>Arrival</th>
                                    <th>Expected Departure</th>
                                    <th>No of Nights</th>
                                    <th>Pax</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $key=>$item)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->room_number}}</td>
                                        <td>{{$item->room_type}}</td>
                                        <td style="text-align: right">{{number_format($item->rate)}}</td>
                                        <td>{{$item->guest}}</td>
                                        <td>{{$item->arrival_date ? date('d M Y',strtotime($item->arrival_date)):""}}</td>
                                        <td>{{$item->arrival_date ? date('d M Y',strtotime($item->departure_date)):""}}</td>
                                        <td style="text-align: right">{{number_format($item->no_of_nights)}}</td>
                                        <td style="text-align: right">{{number_format($item->pax)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        datePickerLoad()
    </script>
@endsection
