<?php

namespace Modules\HotelMgnt\Commands\BookingCharges;

use Exception;
use Modules\HotelMgnt\Models\BookingCharges;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $data['can_modify'] = true;
            BookingCharges::create($data);
            //Sending Notification Back
            return [
                'message' => 'Booking Charges Successfully Created!',
                'type' => 'success'
            ];
        }catch (Exception $exception){
            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }

    }
}
