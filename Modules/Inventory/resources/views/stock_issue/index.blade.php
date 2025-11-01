@extends('layouts.master')
@section('title','Stock Receiving')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">STOCK RECEIVE</h5>
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
                        <th>Requisition Number</th>
                        <th>Issue No</th>
                        <th>Department</th>
                        <th>Issued By</th>
                        <th>Issued At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->requisition_number}}</td>
                            <td>{{$item->issue_number}}</td>
                            <td>{{isset($item->department) ?  $item->department->name: 'Not Defined'}}</td>
                            <td>{{isset($item->issuedBy) ? $item->issuedBy->full_name:'Not Defined'}}</td>
                            <td>{{isset($item->issued_at) ? date('d M Y H:i',strtotime($item->issued_at)) : 'N/A'}}</td>
                            <td style="width: 9%" class="text-center">
                                <a class="text-muted font-16 show-link"
                                   {{--                                       href="{{route('stock-requisition-item.index',['id'=>$item->stock_requisition_id,'type'=>'issue'])}}"--}}
                                   href="{{route('stock-requisition.items',$item->stock_requisition_id)}}"
                                   title="Items" data-toggle="tooltip"><i class="fa fx-2 fa-eye"></i></a>
                                @if($item->received_by == null)
                                    | <a class="text-muted font-16 receive-link"
                                         href="{{route('stock-issue.receive',$item->id)}}"
                                         title="Receive" data-toggle="tooltip"><i class="fa fx-2 fa-check-circle-o"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show_modal" aria-labelledby="create_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Stock Requisition Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-show">
                    <!--Code Goes Here-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>

        $('.show-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-show').load(dataURL, function () {
                $('#show_modal').modal({show: true});
            });
        });

        //For Check In
        $(".receive-link").click(function (e) {
            e.preventDefault();
            const Description = "Requisition " + $(this).closest('tr').children('td.desc_name').text().trim() + " Items Will be Received";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Receive';
            actionConfirm(Description, Url, ButtonText);
        });
    </script>
@endsection
