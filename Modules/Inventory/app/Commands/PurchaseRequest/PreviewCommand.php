<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseRequest;

class PreviewCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $purchaseRequest = PurchaseRequest::find($id);
            $purchaseRequest->previewed_by = auth()->id();
            $purchaseRequest->previewed_at = now();
            $purchaseRequest->status = "Previewed";
            $purchaseRequest->update();
            //Sending Notification Back
            return [
                'message' => 'Purchase Request Successfully Previewed!',
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
