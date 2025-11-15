<?php

namespace Modules\HotelMgnt\Commands\Booking;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Booking;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Booking::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Booking Successfully Deleted!',
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
