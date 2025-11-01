<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\BookingRoomHistory;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomCheckInOut;

class CheckOutCommand
{
    public static function handle($id): array
    {
        //Update RoomCheckInOut Status
        $roomCheckInOut = RoomCheckInOut::find($id);
        $roomCheckInOut->checked_out_by = auth()->id();
        $roomCheckInOut->checked_out_at = now();
        $roomCheckInOut->save();

        //Update Room Status
        $booking = Booking::find($roomCheckInOut->booking_id);
        $room = Room::find($roomCheckInOut->room_id);
        $room->status = 'Available';
        $room->save();

        //Update Booking
        $booking->booking_status = 'CheckedOut';
        $booking->update();

        //Update RoomHistory
        $roomHistory = BookingRoomHistory::where('booking_id', $booking->id)
            ->where('room_id', $room->id)->first();
        $roomHistory->end_date = date('Y-m-d');
        $roomHistory->update();

        //Sending Notification Back
        return [
            'message' => 'Check Out Successfully!',
            'type' => 'success'
        ];
    }
}
