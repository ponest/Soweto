<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Inventory\Models\ItemStockOut;
use Modules\Inventory\Models\StockItem;

class SaveStockOutCommand
{
    public static function handle($item, $storeId, $category): void
    {
        $unitId = StockItem::find($item['itemId'])->unit_id;
        $itemStockOut = new ItemStockOut();
        $itemStockOut->item_id = $item['itemId'];
        $itemStockOut->quantity = $item['quantity'];
        $itemStockOut->category = $category;
        $itemStockOut->unit_id = $unitId;
        $itemStockOut->store_id = $storeId;
        $itemStockOut->save();
    }
}
