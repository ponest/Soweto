<?php

namespace Modules\HotelMgnt\Commands\HouseKeepingLog;
use Modules\HotelMgnt\Models\HouseKeepingLog;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = HouseKeepingLog::isExist($data['room_id'], $data['cleaned_on']);
        if (!$is_exist) {
            HouseKeepingLog::create($data);
            //Sending Notification Back
            return [
                'message' => 'House Keeping Log Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Room Already Cleaned!",
                'type' => 'error'
            ];
        }
    }
}
