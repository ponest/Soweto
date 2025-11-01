<?php

namespace Modules\Inventory\Commands\UnitConversion;

use Modules\Inventory\Models\ItemUnitConversion;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $unitConversion = ItemUnitConversion::find($id);
        $isExist = ItemUnitConversion::isExistOnEdit($data['item_id'],$data['from_unit_id'],$data['to_unit_id'], $id);
        if (!$isExist) {
            $unitConversion->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Unit Conversion Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Unit Conversion  Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
