<?php

namespace Modules\Sales\Commands\PriceApprovalItem;

use Exception;
use Modules\Sales\Models\PriceApprovalItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = PriceApprovalItem::isExist($data['item_id'], $data['price_approval_id']);
            if (!$isExist) {
                PriceApprovalItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Price Approval Item Successfully Created!',
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
