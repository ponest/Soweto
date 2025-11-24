<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseRequest;

class ReviewCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $purchaseRequest = PurchaseRequest::find($id);
            $purchaseRequest->reviewed_by = auth()->id();
            $purchaseRequest->reviewed_at = now();
            $purchaseRequest->status = "Reviewed";
            $purchaseRequest->update();
            //Sending Notification Back
            return [
                'message' => 'Purchase Request Successfully Reviewed!',
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
