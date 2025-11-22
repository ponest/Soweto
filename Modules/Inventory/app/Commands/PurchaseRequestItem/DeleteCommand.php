<?php

namespace Modules\Inventory\Commands\PurchaseRequestItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\PurchaseReqItem;
class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = PurchaseReqItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Stock Purchase Request Item Successfully Deleted!',
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
