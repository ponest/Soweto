<?php

namespace Modules\HotelMgnt\Commands\Room;
use Modules\HotelMgnt\Models\Room;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = Room::isExist($data['room_number']);
        if (!$is_exist) {
            Room::create($data);
            //Sending Notification Back
            return [
                'message' => 'Room Successfully Created!',
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
