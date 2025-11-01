<?php

namespace Modules\Sales\Commands\ItemPriceApproval;

use Exception;
use Modules\Sales\Models\ItemPriceApproval;
use Modules\Sales\Models\PriceApprovalItem;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $priceItems = PriceApprovalItem::where('price_approval_id', $id)->count();
            if ($priceItems > 0) {
                $itemPriceApproval = ItemPriceApproval::find($id);
                $itemPriceApproval->submitted_by = auth()->id();
                $itemPriceApproval->submitted_at = now();
                $itemPriceApproval->status = "Submitted";

                //Remove other states
                $itemPriceApproval->is_approved = null;
                $itemPriceApproval->reviewed_at = null;
                $itemPriceApproval->reviewed_by = null;
                $itemPriceApproval->reject_comments = null;

                $itemPriceApproval->update();
                //Sending Notification Back
                return [
                    'message' => 'Item Price Approval Request Successfully Submitted!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "You can't submit price approval request now!, Please Fill at least one Item",
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
