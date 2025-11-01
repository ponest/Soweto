<?php

namespace Modules\Sales\Commands\MenuPriceApproval;

use Exception;
use Modules\Sales\Models\MenuPriceApproval;
use Modules\Sales\Models\MenuPriceApprovalItem;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $priceItems = MenuPriceApprovalItem::where('menu_price_approval_id', $id)->count();
            if ($priceItems > 0) {
                $menuPriceApproval = MenuPriceApproval::find($id);
                $menuPriceApproval->submitted_by = auth()->id();
                $menuPriceApproval->submitted_at = now();
                $menuPriceApproval->status = "Submitted";

                //Remove other states
                $menuPriceApproval->is_approved = null;
                $menuPriceApproval->reviewed_at = null;
                $menuPriceApproval->reviewed_by = null;
                $menuPriceApproval->reject_comments = null;

                $menuPriceApproval->update();
                //Sending Notification Back
                return [
                    'message' => 'Menu Price Approval Request Successfully Submitted!',
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
