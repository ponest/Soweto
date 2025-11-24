<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\PurchaseRequest;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = PurchaseRequest::find($id);
            $item->delete();

            //Delete Related Models
            $item->items()->delete();
            $item->additionalCost()->delete();

            //Sending Back Notification
            return [
                'message' => 'Purchase Request Successfully Deleted!',
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
