<?php

namespace Modules\HotelMgnt\Commands\RoomType;

use Modules\HotelMgnt\Models\RoomType;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $roomType = RoomType::find($id);
        $isExist = RoomType::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $roomType->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Room Type Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Room Type {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
