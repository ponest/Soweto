@extends('layouts.master')
@section('title','Client Wallet Approval')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">CLIENT WALLET</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <!--Button Goes Here-->
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
                        <th>Client Name</th>
                        <th>Reference No</th>
                        <th>Transaction Reference No</th>
                        <th>Wallet Amount</th>
                        @if($approved_view)
                            <th>Approved By</th>
                            <th>Approved At</th>
                        @endif
                        @if(!$approved_view)
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->client?->full_name}}</td>
                            <td>{{$item->reference_no}}</td>
                            <td>{{$item->transaction_reference_no}}</td>
                            <td style="text-align: right">{{number_format($item->wallet_amount)}}</td>
                            @if($approved_view)
                                <td>{{$item->reviewer?->full_name}}</td>
                                <td>{{$item->reviewed_at}}</td>
                            @endif
                            @if(!$approved_view)
                                <td style="width: 9%" class="text-center">
                                    @if(!$item->reviewed_at)
                                        <a class="text-muted font-16 approve-link" href="{{route('client-wallet.approve',$item->id)}}"
                                           data-toggle="tooltip" title="Approve"><i class="fa fa-check-circle"></i></a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_modal" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-edit">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        $('.edit-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-edit').load(dataURL, function () {
                $('#edit_modal').modal({show: true});
            });
        });

        //For Deleting
        $(".delete-link").click(function (e) {
            e.preventDefault();
            const Description = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(Description, Url);
        });

        $(".approve-link").click(function (e) {
            e.preventDefault();
            const Description = "Client " + $(this).closest('tr').children('td.desc_name').text().trim() + " Wallet Will be Approved";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Submitted';
            actionConfirm(Description, Url, ButtonText);
        });
    </script>
@endsection
