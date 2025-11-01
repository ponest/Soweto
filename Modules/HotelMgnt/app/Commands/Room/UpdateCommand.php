<?php

namespace Modules\HotelMgnt\Commands\Room;

use Modules\HotelMgnt\Models\Room;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $room = Room::find($id);
        $isExist = Room::isExistOnEdit($data['room_number'], $id);
        if (!$isExist) {
            $room->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Room Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Room {$data['room_number']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
