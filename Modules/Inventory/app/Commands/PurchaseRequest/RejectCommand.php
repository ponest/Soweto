<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseRequest;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $purchaseRequest = PurchaseRequest::find($id);
            $purchaseRequest->reviewed_by = auth()->id();
            $purchaseRequest->reviewed_at = now();
            $purchaseRequest->is_approved = false;
            $purchaseRequest->status = "Rejected";
            $purchaseRequest->reject_comments = $data['reject_comments'];

            //Undo Submission
            $purchaseRequest->submitted_by = null;
            $purchaseRequest->submitted_at = null;

            //Update
            $purchaseRequest->update();
            //Sending Notification Back
            return [
                'message' => 'Purchase Request Successfully Rejected!',
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
