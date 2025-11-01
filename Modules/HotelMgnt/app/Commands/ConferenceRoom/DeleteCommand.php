<?php

namespace Modules\HotelMgnt\Commands\ConferenceRoom;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\ConferenceRoom;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = ConferenceRoom::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Conference Room Successfully Deleted!',
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
