<?php

namespace Modules\HotelMgnt\Commands\BookingCharges;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\BookingCharges;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = BookingCharges::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Booking Charges Successfully Deleted!',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}
