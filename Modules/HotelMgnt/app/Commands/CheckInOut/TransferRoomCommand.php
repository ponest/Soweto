<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\BookingRoomHistory;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomCheckInOut;
use Illuminate\Support\Facades\DB;

class TransferRoomCommand
{
    public static function handle($data): array
    {
        return DB::transaction(function () use ($data) {
            //=======Checkout Last Room===========
            //Update Room Status
            $booking = Booking::find($data['booking_id']);
            $room = Room::find($booking->room_id);
            $room->status = 'Available';
            $room->save();

            //Update RoomCheckInOut Status
            $roomCheckInOut = RoomCheckInOut::find($data['id']);
            $roomCheckInOut->remarks = $data['remarks'];
            $roomCheckInOut->checked_out_by = auth()->id();
            $roomCheckInOut->checked_out_at = now();
            $roomCheckInOut->save();

            //Update Booking
            $booking->room_id = $data['new_room_id'];
            $booking->update();

            //Update RoomHistory
            $roomHistory = BookingRoomHistory::where('booking_id', $booking->id)
                ->where('room_id', $room->id)->first();
            $roomHistory->end_date = date('Y-m-d');
            $roomHistory->update();

            //========= End Check Out Last Room==========

            //========== Check In New Room ==============
            //New Room
            $checkIn = new RoomCheckInOut();
            $checkIn->checked_in_at = now();
            $checkIn->checked_in_by = auth()->id();
            $checkIn->booking_id = $data['booking_id'];
            $checkIn->room_id = $data['new_room_id'];
            $checkIn->save();

            //Update New Room Status
            $newRoom = Room::find($data['new_room_id']);
            $newRoom->status = 'Occupied';
            $newRoom->save(); // Fixed: was saving $room instead of $newRoom

            //Create RoomHistory
            BookingRoomHistory::create([
                'booking_id' => $booking->id,
                'room_id' => $data['new_room_id'],
                'start_date' => date('Y-m-d'),
                'rate' => $newRoom->rate_per_night
            ]);

            //======== End of That ===============

            //Sending Notification Back
            return [
                'message' => 'Transfer Successfully!',
                'type' => 'success'
            ];
        });
    }
}
