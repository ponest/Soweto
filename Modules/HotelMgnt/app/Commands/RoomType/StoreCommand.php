<?php

namespace Modules\HotelMgnt\Commands\RoomType;
use Modules\HotelMgnt\Models\RoomType;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = RoomType::isExist($data['name']);
        if (!$is_exist) {
            RoomType::create($data);
            //Sending Notification Back
            return [
                'message' => 'Room Type Successfully Created!',
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
