<?php

namespace Modules\Setups\Commands\ItemCategory;
use Modules\Setups\Models\ItemCategory;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = ItemCategory::isExist($data['name']);
        if (!$isExist) {
            ItemCategory::create($data);
            //Sending Notification Back
            return [
                'message' => 'Item Category Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Item Category {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
