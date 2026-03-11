@extends('layouts.master')
@section('title','Main Dashboard')
@section('styles')
    <style>
        .icon{
            width:60px;
            height:60px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:24px;
        }
    </style>
@endsection
@section('content')
    <h2>Front Office Dashboard</h2>
    <hr>

    <div class="row mb-4 container">

        <!-- Total Revenue -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="icon bg-success text-white rounded-circle mr-4">
                        <i class="fa fa-building"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Total Rooms</h6>
                        <h4 class="font-weight-bold mb-0">
                            {{number_format($totalRooms)}}
                        </h4>
                    </div>

                </div>
            </div>
        </div>

        <!-- Unpaid Bills -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="icon bg-danger text-white rounded-circle mr-4">
                        <i class="fa fa-bed"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Occupied Rooms</h6>
                        <h4 class="font-weight-bold mb-0">
                            {{number_format($occupiedRooms)}}
                        </h4>
                    </div>

                </div>
            </div>
        </div>

        <!-- Daily Revenue -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="icon bg-primary text-white rounded-circle mr-4">
                        <i class="fa fa-check"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Available</h6>
                        <h4 class="font-weight-bold mb-0">
                            {{number_format($availableRooms)}}
                        </h4>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 container">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="icon bg-primary text-white rounded-circle mr-4">
                        <i class="fa fa-sign-in"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Today's CheckIn</h6>
                        <h4 class="font-weight-bold mb-0">
                            {{number_format($checkIns)}}
                        </h4>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="icon bg-primary text-white rounded-circle mr-4">
                        <i class="fa fa-power-off"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Today's CheckOut</h6>
                        <h4 class="font-weight-bold mb-0">
                            {{number_format($checkOuts)}}
                        </h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="roomsPieChart" style="height:400px;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            Highcharts.chart('roomsPieChart', {
                chart: {
                    type: 'pie'
                },

                title: {
                    text: 'Room Status Distribution'
                },

                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },

                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        }
                    }
                },

                series: [{
                    name: 'Rooms',
                    colorByPoint: true,
                    data: [
                        {
                            name: 'Occupied Rooms',
                            y: {{ $occupiedRooms }}
                        },
                        {
                            name: 'Available Rooms',
                            y: {{ $availableRooms }}
                        },
                        {
                            name: 'Total Rooms',
                            y: {{ $totalRooms }}
                        }
                    ]
                }]
            });

        });
    </script>
@endsection

