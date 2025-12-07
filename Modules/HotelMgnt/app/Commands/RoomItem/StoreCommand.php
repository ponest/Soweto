<?php

namespace Modules\HotelMgnt\Commands\RoomItem;
use Modules\HotelMgnt\Models\RoomItem;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = RoomItem::isExist($data['stock_item_id'],$data['room_id']);
        if (!$is_exist) {
            RoomItem::create($data);
            //Sending Notification Back
            return [
                'message' => 'Room Item Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Room Item Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
