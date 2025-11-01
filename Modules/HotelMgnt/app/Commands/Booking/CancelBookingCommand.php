<?php

namespace Modules\HotelMgnt\Commands\Booking;

use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Room;

class CancelBookingCommand
{
    public static function handle($data): array
    {
        $id = $data['id'];
        $booking = Booking::find($id);
        $booking->booking_status = 'Cancelled';
        $booking->cancelled_by = auth()->id();
        $booking->cancelled_at = now();
        $booking->cancellation_remarks = $data['cancellation_remarks'];
        $booking->update();

        //Update room status
        $room = Room::find($booking->room_id);
        $room->status = 'Available';
        $room->update();

        //Sending Notification Back
        return [
            'message' => 'Cancellation Successfully!',
            'type' => 'success'
        ];
    }
}
