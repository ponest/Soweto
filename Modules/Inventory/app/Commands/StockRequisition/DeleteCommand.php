<?php

namespace Modules\Inventory\Commands\StockRequisition;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\StockRequisition;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = StockRequisition::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Stock Requisition Successfully Deleted!',
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
