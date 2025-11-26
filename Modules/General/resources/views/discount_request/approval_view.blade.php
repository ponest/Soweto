@extends('layouts.master')
@section('title','Discount Request')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">DISCOUNT REQUEST</h5>
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
                        <th>Request Number</th>
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
                                @if($item->is_approved ==null)
                                    @can('Manager')
                                        <a class="text-muted font-16 review-link"
                                           href="{{route('discount-req.review',$item->id)}}"
                                           title="Review" data-toggle="tooltip"><i
                                                    class="fa fx-2 fa-check-circle-o"></i></a>
                                    @endcan

                                    @can('Director')
                                        <a class="text-muted font-16 approve-link"
                                           href="{{route('discount-req.approve',$item->id)}}"
                                           title="Approve" data-toggle="tooltip"><i
                                                    class="fa fx-2 fa-check-circle-o"></i></a>
                                    @endcan

                                    | <a class="text-muted font-16 reject-link"
                                         href="{{route('stock-requisition.reject-view',$item->id)}}"
                                         title="Reject" data-toggle="tooltip"><i
                                                class="fa fx-2 fa-close"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reject_modal" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-reject">
                <!--Edit Form Loads Here-->
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

        $(".review-link").click(function (e) {
            e.preventDefault();
            const Description = "Request " + $(this).closest('tr').children('td.desc_name').text().trim() + " Will be Reviewed";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Review';
            actionConfirm(Description, Url, ButtonText);
        });

    </script>
@endsection
