<?php

namespace Modules\Inventory\Commands\StockItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\StockItem;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = StockItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Item Successfully Deleted!',
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
