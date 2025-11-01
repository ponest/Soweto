<?php

namespace Modules\Inventory\Commands\UnitConversion;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\ItemUnitConversion;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = ItemUnitConversion::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Item Unit Conversion Successfully Deleted!',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}
