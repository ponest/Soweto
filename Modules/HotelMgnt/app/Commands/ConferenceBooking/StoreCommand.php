<?php

namespace Modules\HotelMgnt\Commands\ConferenceBooking;

use Modules\HotelMgnt\Models\ConferenceBooking;

class StoreCommand
{
    public static function handle($data): array
    {
        $data['booking_status'] = 'Reserved';
        $data['created_by'] = auth()->id();
        $data['reference_number'] = 'BK-'.now()->timestamp;
        $data['number_of_people'] = rand(1, 10);
        $data['amount_paid'] = 0;
        $data['discount_percentage'] = 0;
        ConferenceBooking::create($data);

        //Sending Notification Back
        return [
            'message' => 'Booking Successfully Created!',
            'type' => 'success'
        ];
    }
}
