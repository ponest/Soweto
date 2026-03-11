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
    <h2>Account Dashboard</h2>
    <hr>

    <div class="row mb-4">

        <!-- Total Revenue -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="icon bg-success text-white rounded-circle mr-4">
                        <i class="fa fa-money"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Total Revenue</h6>
                        <h4 class="font-weight-bold mb-0">
                            TZS {{number_format($totalRevenue)}}
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
                        <i class="fa fa-file-text"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Unpaid Bills</h6>
                        <h4 class="font-weight-bold mb-0">
                            TZS {{number_format($unpaidBills)}}
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
                        <i class="fa fa-calendar"></i>
                    </div>

                    <div>
                        <h6 class="text-muted mb-1">Today's Revenue</h6>
                        <h4 class="font-weight-bold mb-0">
                            TZS {{number_format($dailyRevenue)}}
                        </h4>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div id="revenueChart"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div id="paymentMethodChart"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        Highcharts.chart('revenueChart', {

            chart: {
                type: 'line'
            },

            title: {
                text: '7 Day Revenue Trend'
            },

            xAxis: {
                categories: @json($dates)
            },

            yAxis: {
                title: {
                    text: 'Revenue'
                }
            },

            tooltip: {
                valuePrefix: 'TZS '
            },

            series: [{
                name: 'Daily Revenue',
                data: @json($amounts)
            }]

        });

        //Payment Method
        Highcharts.chart('paymentMethodChart', {

            chart: {
                type: 'column'
            },

            title: {
                text: 'Revenue by Payment Method (Last 7 Days)'
            },

            xAxis: {
                categories: @json($dates)
            },

            yAxis: {
                title: {
                    text: 'Revenue (TZS)'
                }
            },

            tooltip: {
                shared: true,
                valuePrefix: 'TZS '
            },

            plotOptions: {
                column: {
                    borderRadius: 5
                }
            },

            series: @json($series)

        });
    </script>
@endsection

