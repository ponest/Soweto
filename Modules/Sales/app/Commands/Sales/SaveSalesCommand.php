<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Sales\Models\Sale;

class SaveSalesCommand
{
    public static function handle($item, $storeId, $sale_batch,$staff_id)
    {
        Sale::create([
            'sales_batch_id' => $sale_batch->id,
            'unit_price' => $item['price'],
            'quantity' => $item['quantity'],
            'total_price' => $item['total'],
            'ref_id' => $item['itemId'],
            'item_name' => $item['itemName'],
            'store_id' => $storeId,
            'waiter_id' => $staff_id,
        ]);
    }
}
