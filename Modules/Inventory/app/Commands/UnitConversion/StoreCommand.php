<?php

namespace Modules\Inventory\Commands\UnitConversion;

use Modules\Inventory\Models\ItemUnitConversion;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = ItemUnitConversion::isExist($data['item_id'],$data['from_unit_id'],$data['to_unit_id']);
        if (!$isExist) {
            ItemUnitConversion::create($data);
            //Sending Notification Back
            return [
                'message' => 'Unit Conversion Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Unit Conversion Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
