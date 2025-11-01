<?php

namespace Modules\HotelMgnt\Commands\Booking;

use Modules\HotelMgnt\Models\Booking;

class StoreCommand
{
    public static function handle($data): array
    {
        $start_date = $data['proposed_start_date'];
        $end_date = $data['proposed_end_date'];

        // Check if room is already booked or occupied
        $isBooked = Booking::where('room_id', $data['room_id'])
            ->whereIn('booking_status', ['Reserved', 'CheckedIn'])
            ->where(function ($query) use ($start_date, $end_date) {
                $query->where('proposed_start_date', '<=', $end_date)
                    ->where('proposed_end_date', '>=', $start_date);
            })->exists();

        if ($isBooked) {
            return [
                'message' => 'Room is already booked or occupied for the selected dates!',
                'type' => 'error'
            ];
        }

        $data['booking_status'] = 'Reserved';
        $data['created_by'] = auth()->id();
        $data['reference_number'] = 'BK-'.now()->timestamp;
        Booking::create($data);

        //Sending Notification Back
        return [
            'message' => 'Booking Successfully Created!',
            'type' => 'success'
        ];
    }
}
