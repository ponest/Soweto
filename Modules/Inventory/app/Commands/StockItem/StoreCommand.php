<?php

namespace Modules\Inventory\Commands\StockItem;

use Modules\Inventory\Models\StockItem;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = StockItem::isExist($data['name']);
        if (!$isExist) {
            StockItem::create($data);
            //Sending Notification Back
            return [
                'message' => 'Item Successfully Created!',
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
