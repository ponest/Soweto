<?php

namespace Modules\HotelMgnt\Commands\RoomItem;

use Modules\HotelMgnt\Models\RoomItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $roomItem = RoomItem::find($id);
        $isExist = RoomItem::isExistOnEdit($data['stock_item_id'],$roomItem->room_id, $id);
        if (!$isExist) {
            $roomItem->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Room Item Successfully Updated',
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
