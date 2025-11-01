<?php

namespace Modules\Inventory\Commands\StockItem;

use Modules\Inventory\Models\StockItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $stockItem = StockItem::find($id);
        $isExist = StockItem::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $stockItem->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Item Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Item {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
