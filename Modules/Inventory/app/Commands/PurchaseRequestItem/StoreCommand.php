<?php

namespace Modules\Inventory\Commands\PurchaseRequestItem;

use Exception;
use Modules\Inventory\Models\PurchaseReqItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = PurchaseReqItem::isExist($data['stock_item_id'], $data['purchase_request_id']);
            if (!$isExist) {
                PurchaseReqItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Purchase Request Item Successfully Created!',
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
