<?php

namespace Modules\Inventory\Commands\StockIssue;

use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\StockRequisitionItem;

class ConfirmItemCommand
{
    public static function handle($data): array
    {
        $stockReqItem = StockRequisitionItem::find($data['id']);
        $balance = StockItem::getStoreItemBalance($stockReqItem->stock_item_id);
        if ($balance >= $data['issued_quantity']) {
            //Update Stock Item
            $stockReqItem->issued_quantity = $data['issued_quantity'];
            $stockReqItem->is_issued = true;
            $stockReqItem->update();
            return [
                'message' => 'Stock Item Successfully Confirmed!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => 'Issued Quantity Exceed the Balance Limit!',
                'type' => 'error'
            ];
        }
    }
}

