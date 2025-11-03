@extends('layouts.master')
@section('title','Client Wallet')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">CLIENT WALLET</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_modal">
                        <i class="fa fa-plus-circle"></i> Add New
                    </button>
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
                        <th>Payment Method</th>
                        <th>Reference No</th>
                        <th>Transaction Reference No</th>
                        <th>Wallet Amount</th>
                        <th>Reject Comment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->client?->full_name}}</td>
                            <td>{{$item->paymentMethod?->name}}</td>
                            <td>{{$item->reference_no}}</td>
                            <td>{{$item->transaction_reference_no}}</td>
                            <td style="text-align: right">{{number_format($item->wallet_amount)}}</td>
                            <td>{{$item->reject_comments}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$item->submitted_at)
                                <a class="text-muted font-16 edit-link" href="{{route('client-wallet.edit',$item->id)}}"
                                   title="Edit"><i class="fa fa-edit"></i></a> |
                                <a class="text-muted font-16 delete-link" href="{{route('client-wallet.destroy',$item->id)}}"
                                   title="Delete"><i class="fa fa-trash-o"></i></a>
                                | <a class="text-muted font-16 submit-link" href="{{route('client-wallet.submit',$item->id)}}"
                                         title="Submit"><i class="fa fa-check-circle"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Create Modal && Edit Modal -->
    @include('hotelmgnt::client_wallet.create')

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

        $(".submit-link").click(function (e) {
            e.preventDefault();
            const Description = "Client " + $(this).closest('tr').children('td.desc_name').text().trim() + " Wallet Will be Submitted";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Submitted';
            actionConfirm(Description, Url, ButtonText);
        });
    </script>
@endsection
