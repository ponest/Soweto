<?php

namespace Modules\HotelMgnt\Commands\RoomItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\RoomItem;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = RoomItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Room Item Successfully Deleted!',
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
