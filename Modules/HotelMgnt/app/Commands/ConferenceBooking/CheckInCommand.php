<?php

namespace Modules\HotelMgnt\Commands\Booking;

use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Room;

class CheckInCommand
{
    public static function handle($id): array
    {
        $booking = Booking::find($id);
        $booking->booking_status = 'Checked In';
        $booking->check_in_date = now();
        $booking->update();

        //Update room status
        $room = Room::find($booking->room_id);
        $room->status = 'Occupied';
        $room->update();

        //Sending Notification Back
        return [
            'message' => 'Check In Successfully!',
            'type' => 'success'
        ];
    }
}
