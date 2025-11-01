<?php

namespace Modules\Inventory\Commands\StockRequisitionItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\StockRequisitionItem;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = StockRequisitionItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Stock Requisition Item Successfully Deleted!',
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
