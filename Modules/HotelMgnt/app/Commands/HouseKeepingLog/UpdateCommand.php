<?php

namespace Modules\HotelMgnt\Commands\HouseKeepingLog;

use Modules\HotelMgnt\Models\HouseKeepingLog;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $houseKeeping = HouseKeepingLog::find($id);
        $isExist = HouseKeepingLog::isExistOnEdit($data['room_id'], $data['cleaned_on'], $id);
        if (!$isExist) {
            $houseKeeping->update($data);

            //Sending Notification Back to Roles
            return [
                'message' => 'House Keeping Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Room  Already Cleaned!",
                'type' => 'error'
            ];
        }
    }
}
