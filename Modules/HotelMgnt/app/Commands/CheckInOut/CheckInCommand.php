<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\BookingRoomHistory;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomCheckInOut;

class CheckInCommand
{
    public static function handle($data): array
    {
        //Check if Room is Available
        $booking = Booking::find($data['booking_id']);
        $room = Room::find($booking->room_id);

        if ($room->status == 'Available') {
            $checkIn = new RoomCheckInOut();
            $checkIn->checked_in_at = now();
            $checkIn->checked_in_by = auth()->id();
            $checkIn->booking_id = $data['booking_id'];
            $checkIn->room_id = $booking->room_id;
            $checkIn->save();

            //Update room status
            $room = Room::find($booking->room_id);
            $room->status = 'Occupied';
            $room->update();

            //Update RoomHistory
            BookingRoomHistory::create([
                'booking_id' => $booking->id,
                'room_id' => $booking->room_id,
                'start_date' => now(),
                'rate'=> $room->rate_per_night
            ]);

            //Update Booking Status
            $booking->booking_status = 'CheckedIn';
            $booking->update();

            //Sending Notification Back
            return [
                'message' => 'Check In Successfully!',
                'type' => 'success'
            ];

        } else {
            return [
                'message' => 'You Cant Check In, The Room is not Available!',
                'type' => 'error'
            ];
        }
    }
}
