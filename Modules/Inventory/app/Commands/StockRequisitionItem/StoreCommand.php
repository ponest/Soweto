<?php

namespace Modules\Inventory\Commands\StockRequisitionItem;

use Exception;
use Modules\Inventory\Models\StockRequisitionItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = StockRequisitionItem::isExist($data['stock_item_id'], $data['stock_requisition_id']);
            if (!$isExist) {
                StockRequisitionItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Stock Requisition Item Successfully Created!',
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
