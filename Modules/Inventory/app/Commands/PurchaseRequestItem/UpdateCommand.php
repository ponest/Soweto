<?php

namespace Modules\Inventory\Commands\PurchaseRequestItem;

use Exception;
use Modules\Inventory\Models\PurchaseReqItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $requestItem = PurchaseReqItem::find($id);
            $isExist = PurchaseReqItem::isExistOnEdit($data['stock_item_id'], $requestItem->purchase_request_id, $id);
            if (!$isExist) {
                $requestItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Stock Purchase Request Item Successfully Updated',
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
