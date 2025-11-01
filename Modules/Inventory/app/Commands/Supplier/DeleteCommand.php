<?php

namespace Modules\Inventory\Commands\Supplier;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\Supplier;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Supplier::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Supplier Successfully Deleted!',
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
