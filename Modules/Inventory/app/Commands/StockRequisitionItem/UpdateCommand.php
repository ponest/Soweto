<?php

namespace Modules\Inventory\Commands\StockRequisitionItem;

use Exception;
use Modules\Inventory\Models\StockRequisitionItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $requisitionItem = StockRequisitionItem::find($id);
            $isExist = StockRequisitionItem::isExistOnEdit($data['stock_item_id'], $requisitionItem->stock_requisition_id, $id);
            if (!$isExist) {
                $requisitionItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Stock Requisition Item Successfully Updated',
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
