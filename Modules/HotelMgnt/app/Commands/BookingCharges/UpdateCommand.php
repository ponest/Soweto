<?php

namespace Modules\HotelMgnt\Commands\BookingCharges;

use Exception;
use Modules\HotelMgnt\Models\BookingCharges;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $bookingCharges = BookingCharges::find($id);
            $bookingCharges->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Booking Charges Successfully Updated',
                'type' => 'success'
            ];
        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
