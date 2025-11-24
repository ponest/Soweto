<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Sales\Models\BillItem;

class SaveBillItemsCommand
{
    public static function handle($bill, $item, $storeId)
    {
        $billItem = new BillItem();
        $billItem->bill_id = $bill->id;
        $billItem->item_name = $item['itemName'];
        $billItem->unit_price = $item['price'];
        $billItem->quantity = $item['quantity'];
        $billItem->total_price = $item['total'];
        $billItem->store_id = $storeId;
        $billItem->save();
    }
}
