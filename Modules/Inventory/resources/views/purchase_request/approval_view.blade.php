@extends('layouts.master')
@section('title','Purchase Stock Request')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">STOCK PURCHASE REQUEST</h5>
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
                        <th>Requisition No</th>
                        <th>Description</th>
                        <th>Submitted By</th>
                        <th>Submitted At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td style="width: 5%">{{++$key}}</td>
                            <td class="desc_name">{{$item->request_number}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{isset($item->submittedBy) ? $item->submittedBy->full_name:'Not Submitted'}}</td>
                            <td>{{isset($item->submitted_at) ? date('d M Y H:i',strtotime($item->submitted_at)) : 'N/A'}}</td>
                            <td>{{$item->status}}</td>
                            <td style="width: 9%" class="text-center">
                                <a class="text-muted font-16 show-link"
                                   href="{{route('purchase-request.items',$item->id)}}"
                                   title="Items" data-toggle="tooltip"><i class="fa fx-2 fa-eye"></i></a>
                                @can('Cashier')
                                    @if($item->previewed_by ==null)
                                        | <a class="text-muted font-16 preview-link"
                                             href="{{route('purchase-request.preview',$item->id)}}"
                                             title="Forward" data-toggle="tooltip"><i
                                                    class="fa fx-2 fa-fast-forward"></i></a>
                                    @endif
                                @endcan
                                @can('Manager')
                                    @if($item->reviewed_by ==null)
                                        | <a class="text-muted font-16 review-link"
                                             href="{{route('purchase-request.review',$item->id)}}"
                                             title="Review" data-toggle="tooltip"><i
                                                    class="fa fx-2 fa-check-circle-o"></i></a>
                                    @endif
                                @endcan
                                @can('Director')
                                    @if($item->approved_by ==null)
                                        | <a class="text-muted font-16 approve-link"
                                             href="{{route('purchase-request.approve',$item->id)}}"
                                             title="Approve" data-toggle="tooltip"><i
                                                    class="fa fx-2 fa-check-circle-o"></i></a>
                                    @endif
                                @endcan
                                {{--                                @if($item->is_approved ==null)--}}
                                {{--                                    | <a class="text-muted font-16 approve-link"--}}
                                {{--                                       href="{{route('purchase-request.preview',$item->id)}}"--}}
                                {{--                                       title="Approve" data-toggle="tooltip"><i--}}
                                {{--                                                class="fa fx-2 fa-check-circle-o"></i></a>--}}
                                {{--                                    | <a class="text-muted font-16 reject-link"--}}
                                {{--                                         href="{{route('stock-requisition.reject-view',$item->id)}}"--}}
                                {{--                                         title="Reject" data-toggle="tooltip"><i--}}
                                {{--                                                class="fa fx-2 fa-close"></i></a>--}}
                                {{--                                @endif--}}

{{--                                | <a class="text-muted font-16 reject-link"--}}
{{--                                     href="{{route('stock-requisition.reject-view',$item->id)}}"--}}
{{--                                     title="Reject" data-toggle="tooltip"><i--}}
{{--                                            class="fa fx-2 fa-close"></i></a>--}}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(!$approved_view)
        <div class="modal fade" id="reject_modal" aria-labelledby="edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-reject">
                    <!--Edit Form Loads Here-->
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="show_modal" aria-labelledby="create_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_modal">Stock Purchase Request Items</h5>
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

        $('.reject-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-reject').load(dataURL, function () {
                $('#reject_modal').modal({show: true});
            });
        });

        $(".approve-link").click(function (e) {
            e.preventDefault();
            const Description = "Request " + $(this).closest('tr').children('td.desc_name').text().trim() + " Will be Approved";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Approve';
            actionConfirm(Description, Url, ButtonText);
        });

        $(".preview-link").click(function (e) {
            e.preventDefault();
            const Description = "Request " + $(this).closest('tr').children('td.desc_name').text().trim() + " Will be Forwarded";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Forward';
            actionConfirm(Description, Url, ButtonText);
        });

        $(".review-link").click(function (e) {
            e.preventDefault();
            const Description = "Request " + $(this).closest('tr').children('td.desc_name').text().trim() + " Will be Reviewed";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Review';
            actionConfirm(Description, Url, ButtonText);
        });

    </script>
@endsection
