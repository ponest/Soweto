<?php

namespace Modules\Sales\Commands\PriceApprovalItem;

use Exception;
use Modules\Sales\Models\PriceApprovalItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $priceApprovalItem = PriceApprovalItem::find($id);
            $isExist = PriceApprovalItem::isExistOnEdit($data['item_id'], $priceApprovalItem->price_approval_id, $id);
            if (!$isExist) {
                $priceApprovalItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Price Approval Item Successfully Updated',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Item Already Exist!",
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
