<?php

namespace Modules\HotelMgnt\Commands\HouseKeepingLog;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\HouseKeepingLog;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = HouseKeepingLog::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'House Keeping Successfully Deleted!',
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
