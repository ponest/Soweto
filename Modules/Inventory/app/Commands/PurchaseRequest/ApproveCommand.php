<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseRequest;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            $purchaseRequest = PurchaseRequest::find($id);
            $purchaseRequest->approved_by = auth()->id();
            $purchaseRequest->approved_at = now();
            $purchaseRequest->is_approved = true;
            $purchaseRequest->status = "Approved";
            $purchaseRequest->update();
            //Sending Notification Back
            return [
                'message' => 'Purchase Request Successfully Approved!',
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
