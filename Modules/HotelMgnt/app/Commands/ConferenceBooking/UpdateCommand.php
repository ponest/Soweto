<?php

namespace Modules\HotelMgnt\Commands\Booking;

use Modules\HotelMgnt\Models\Booking;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $guest = Booking::find($id);
        $guest->update($data);
        //Sending Notification Back
        return [
            'message' => 'Booking Successfully Updated',
            'type' => 'success'
        ];
    }
}
