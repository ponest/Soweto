<?php

namespace Modules\HotelMgnt\Commands\Booking;

use App\Helpers\General;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Room;

class CheckOutCommand
{
    public static function handle($id): array
    {
        $booking = Booking::find($id);
        $booking->booking_status = 'Checked Out';
        $booking->check_out_date = now();
        $number_of_days = General::daysBetweenInclusive($booking->check_in_date, $booking->check_out_date);
        $booking->price = $booking->room->rate_per_night * $number_of_days;
        $booking->update();

        //Update room status
        $room = Room::find($booking->room_id);
        $room->status = 'Available';
        $room->update();

        //Sending Notification Back
        return [
            'message' => 'Check Out Successfully!',
            'type' => 'success'
        ];
    }
}
