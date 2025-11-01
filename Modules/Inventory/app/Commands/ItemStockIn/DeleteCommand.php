<?php

namespace Modules\Inventory\Commands\ItemStockIn;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\ItemStockIn;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = ItemStockIn::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Item Stock In Successfully Deleted!',
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
