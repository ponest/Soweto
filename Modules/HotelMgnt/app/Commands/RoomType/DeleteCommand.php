<?php

namespace Modules\HotelMgnt\Commands\RoomType;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\RoomType;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = RoomType::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Room Type Successfully Deleted!',
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
