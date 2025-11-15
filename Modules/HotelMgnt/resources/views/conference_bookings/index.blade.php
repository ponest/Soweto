@extends('layouts.master')
@section('title','Bookings')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">CONFERENCE BOOKINGS</h5>
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
                        <th>Guest Name</th>
                        <th>Room Number</th>
                        <th>Check In Date</th>
                        <th>Check Out Date</th>
                        <th>Booking Status</th>
                        <th>Total Amount Paid</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td class="desc_name">{{$item->guest?->full_name}}</td>
                            <td>{{isset($item->room) ? $item->room->room_number : ''}}</td>
                            <td>{{$item->check_in_date}}</td>
                            <td>{{isset($item->check_out_date) ? date('d M Y H:i:s',strtotime($item->check_out_date)) : ''}}</td>
                            <td>{{$item->booking_status}}</td>
                            <td style="text-align: right">{{number_format($item->price)." TZS"}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$item->check_in_date)
                                    <a class="text-muted font-16 edit-link" href="{{route('bookings.edit',$item->id)}}"
                                       title="Edit"><i class="fa fa-edit"></i></a> |
                                    <a class="text-muted font-16 delete-link"
                                       href="{{route('bookings.destroy',$item->id)}}"
                                       title="Delete"><i class="fa fa-trash-o"></i></a>
                                    |
                                    <a class="text-muted font-16 check-in-link"
                                       href="{{route('bookings.check-in',$item->id)}}"
                                       title="Check In"><i class="fa fa-check-square"></i></a>
                                @endif
                                @if(!$item->check_out_date && $item->check_in_date)
                                    <a class="text-muted font-16 check-out-link"
                                       href="{{route('bookings.check-out',$item->id)}}"
                                       title="Check Out"><i class="fa fa-window-close"></i></a>
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
    @include('hotelmgnt::conference_bookings.create')

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

        //For Check In
        $(".check-in-link").click(function (e) {
            e.preventDefault();
            const Description = "Guest " + $(this).closest('tr').children('td.desc_name').text().trim() + "Will be Checked In";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Check In';
            actionConfirm(Description, Url, ButtonText);
        });

        datePickerLoad();

    </script>
@endsection
