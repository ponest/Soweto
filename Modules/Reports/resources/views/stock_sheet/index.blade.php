@extends('layouts.master')
@section('title','Payment History')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <!-- Top Card for Search -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="font-strong mb-0">Search Stock Sheet</h5>
                </div>
                <div class="card-body">
                    <form autocomplete="off" method="post" action="{{route('daily-stock')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <select name="store_id" class="form-control form-control-air">
                                    <option value="">Choose Store</option>
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}">{{$store->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

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
                                    <a href="{{route('daily-stock-excel')}}" class="btn btn-primary">
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
                                    <th>Item</th>
                                    <th>OP</th>
                                    <th>ADD</th>
                                    <th>TOTAL</th>
                                    <th>CL</th>
                                    <th>SOLD</th>
                                    <th>PRICE</th>
                                    <th>TOTAL PRICE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $key=>$item)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td class="desc_name">{{$item->stockItem?->name}}</td>
                                        <td style="text-align: right">{{number_format($item->opening_stock)}}</td>
                                        <td style="text-align: right">{{number_format($item->additional_stock)}}</td>
                                        <td style="text-align: right">{{number_format($item->total_stock)}}</td>
                                        <td style="text-align: right">{{number_format($item->closing_stock)}}</td>
                                        <td style="text-align: right">{{number_format($item->sold_qty)}}</td>
                                        <td style="text-align: right">{{number_format($item->unit_price)}}</td>
                                        <td style="text-align: right">{{number_format($item->total_price)}}</td>
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
