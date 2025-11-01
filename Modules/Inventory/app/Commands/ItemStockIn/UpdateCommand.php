<?php

namespace Modules\Inventory\Commands\ItemStockIn;

use Exception;
use Modules\Inventory\Models\ItemStockIn;
use Modules\Inventory\Models\ItemUnitConversion;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $itemStockIn = ItemStockIn::find($id);
            $item_conversion = ItemUnitConversion::getConversion($data['item_id'], $data['base_unit_id']);
            if ($item_conversion) {
                $data['converted_unit_id'] = $item_conversion->to_unit_id;
                $data['converted_quantity'] = $item_conversion->multiplier * $data['base_quantity'];
            } else {
                $data['converted_unit_id'] = $data['base_unit_id'];
                $data['converted_quantity'] = $data['base_quantity'];
            }

            $itemStockIn->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Item Stock In Successfully Updated',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
