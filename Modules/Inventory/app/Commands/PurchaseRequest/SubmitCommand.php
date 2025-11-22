<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseReqItem;
use Modules\Inventory\Models\PurchaseRequest;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $purchase_items = PurchaseReqItem::where('purchase_request_id', $id)->count();
            if ($purchase_items > 0) {
                $purchaseRequest = PurchaseRequest::find($id);
                $purchaseRequest->submitted_by = auth()->id();
                $purchaseRequest->submitted_at = now();
                $purchaseRequest->status = "Submitted";

                //Remove other states
                $purchaseRequest->is_approved = null;
                $purchaseRequest->reviewed_at = null;
                $purchaseRequest->reviewed_by = null;
                $purchaseRequest->reject_comments = null;

                $purchaseRequest->update();
                //Sending Notification Back
                return [
                    'message' => 'Purchase Request Successfully Submitted!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "You can't submit purchase request now!, Please Fill at-least one Item",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
