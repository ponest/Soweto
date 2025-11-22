<?php

namespace Modules\Inventory\Commands\PurchaseReqCost;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\PurchaseReqAdditionalCost;
class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = PurchaseReqAdditionalCost::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Additional Cost Successfully Deleted!',
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
