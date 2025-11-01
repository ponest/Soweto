<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Illuminate\Support\Facades\DB;
use Modules\HotelMgnt\Models\RoomCheckInOut;
use Modules\Sales\Models\Bill;

class ConfirmPaymentCommand
{
    public static function handle($data): array
    {
        return DB::transaction(function () use ($data) {

            if ($data['payment_method'] != 'Cash') {
                if ($data['payment_reference'] == null) {
                    //Sending Notification Back
                    return [
                        'message' => 'Please fill payment reference!',
                        'type' => 'error'
                    ];
                }
            }

            $bookingId = $data['booking_id'];
            $bill = Bill::where('booking_id', $bookingId)->first();
            $bill->paid_amount = $data['paid_amount'];
            $bill->payment_reference = $data['payment_reference'];
            $bill->payment_method = $data['payment_method'];
            $bill->payment_confirmed_at = now();
            $bill->payment_confirmed_by = auth()->id();
            $bill->save();

            $roomCheckinout = RoomCheckInOut::find($data['id']);
            $roomCheckinout->is_paid = true;
            $roomCheckinout->paid_amount = $data['paid_amount'];
            $roomCheckinout->payment_method = $data['payment_method'];
            $roomCheckinout->payment_reference = $data['payment_reference'];
            $roomCheckinout->save();

            //Sending Notification Back
            return [
                'message' => 'Payment Successfully Confirmed!',
                'type' => 'success'
            ];
        });
    }

}
