@extends('layouts.master')
@section('title','Check In/Out')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">ROOM CHECK IN - CHECKOUT</h5>
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
                        <th>Booking Reference</th>
                        <th>Client Name</th>
                        <th>Room Number</th>
                        <th>Checked In At</th>
                        <th>Check In By</th>
                        <th>Checked Out</th>
                        <th>Checked Out By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td class="desc_name">{{$item->booking?->reference_number}}</td>
                            <td>{{$item->booking?->client?->full_name}}</td>
                            <td>{{$item->room?->room_number}}</td>
                            <td>{{date('d M Y H:i', strtotime($item->checked_in_at))}}</td>
                            <td>{{$item->checkedInBy?->full_name}}</td>
                            <td>{{$item->checked_out_at != null ? date('d M Y H:i', strtotime($item->checked_out_at)):'---'}}</td>
                            <td>{{$item->checkedOutBy?->full_name}}</td>
                            <td style="width: 9%" class="text-center">
                                @if(!$item->checked_out_at)
                                    <a class="text-muted font-16 transfer-link"
                                       href="{{route('room.transfer-view',$item->id)}}"
                                       title="Transfer Room" data-toggle="tooltip"><i class="fa fa-refresh"></i></a>

                                    @if($item->is_billed)
                                        | <a class="text-muted font-16"
                                                href="{{route('room-download-bill',$item->booking_id)}}"
                                                title="Download Bill" data-toggle="tooltip"><i
                                                    class="fa fa-download"></i></a>

                                        @if(!$item->is_paid)
                                            | <a class="text-muted font-16 conf-payment-link"
                                                 href="{{route('room-confirm-payment-view',$item->id)}}"
                                                 title="Confirm Payment" data-toggle="tooltip"><i class="fa fa-check-circle"></i></a>
                                        @endif
                                    @endif

                                    @if($item->is_paid)
                                        | <a class="text-muted font-16 check-out-link"
                                             href="{{route('room-check-out',$item->id)}}"
                                             title="Check Out" data-toggle="tooltip"><i class="fa fa-window-close"></i></a>
                                    @endif

                                    @if(!$item->is_billed)
                                        | <a class="text-muted font-16 compute-bill"
                                             href="{{route('room-compute-bill',$item->id)}}"
                                             title="Compute Bill" data-toggle="tooltip"><i class="fa fa-calculator"></i></a>
                                    @endif
                                    | <a class="text-muted font-16"
                                         href="{{route('booking-charges.index',$item->booking_id)}}"
                                         title="Charges" data-toggle="tooltip"><i
                                                class="fa fa-arrow-circle-o-right"></i></a>
                                @else
                                    <span>No Action</span>
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
    @include('hotelmgnt::check_in_out.check_in')

    <div class="modal fade" id="transfer_modal" aria-labelledby="transfer_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-transfer">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="conf_payment_modal" aria-labelledby="conf_payment_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-conf-payment">
                <!--Edit Form Loads Here-->
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        $('.transfer-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-transfer').load(dataURL, function () {
                $('#transfer_modal').modal({show: true});
            });
        });

        $('.conf-payment-link').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-conf-payment').load(dataURL, function () {
                $('#conf_payment_modal').modal({show: true});
            });
        });

        $("#conf_payment_modal").on('show.bs.modal', function (e) {
            $('select').select2({
                width: '100%'
            });

            $("#payment_method_id").on('change', function (e) {
                const paymentMethodId = $(this).val();
                if (paymentMethodId === "4") {
                    $(".hid_div").css("display", "block");
                }else{
                    $(".hid_div").css("display", "none");
                }
            });

            $("#payment_form").on('submit', function (e) {
                e.preventDefault();

                const paidAmount = parseFloat($("#paid_amount").val()) || 0;
                const walletBalance = parseFloat($("#wallet_balance").val()) || 0;

                if (paidAmount > walletBalance) {
                    swal("Warning", "The wallet balance is smaller than the paid amount", "warning");
                } else {
                    // Proceed with form submission
                    this.submit();
                }
            });


        });

        //For Check In
        $(".check-out-link").click(function (e) {
            e.preventDefault();
            const descRef = $(this).closest('tr').children('td.desc_name').text().trim();
            const Description = "Reservation Number " + descRef + "Will be Checked Out";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Check Out';
            actionConfirm(Description, Url, ButtonText);
        });

        //For Check In
        $(".compute-bill").click(function (e) {
            e.preventDefault();
            const descRef = $(this).closest('tr').children('td.desc_name').text().trim();
            const Description = "Reservation Number " + descRef + " Bill Will be Calculated";
            const Url = $(this).attr('href');
            const ButtonText = 'Yes, Calculate';
            actionConfirm(Description, Url, ButtonText);
        });

        datePickerLoad();




        function verifyWallet()
        {
            const referenceNumber = $("#payment_reference").val();

            $.ajax({
                url: '{{ route("client-wallet.details") }}', // 👈 make sure route name or URL matches your controller route
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF protection
                    reference_no: referenceNumber,
                },
                success: function (response) {
                    if (response.success === true) {
                        swal("Success", response.message, 'success');
                        $("#wallet_amount").val(response.wallet_amount);
                        $("#wallet_balance").val(response.balance);
                    } else {
                        swal("Error", response.message, 'error');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    swal("Error", 'Something went wrong. Please try again.', 'error');
                }
            });
        }
    </script>
@endsection
