<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Sales\Models\Bill;
use Modules\Sales\Models\BillItem;

class SaveBillItemsCommand
{
    public static function handle($bill, $item, $storeId, $staffId)
    {
        $billItem = new BillItem();
        $billItem->bill_id = $bill->id;
        $billItem->item_name = $item['itemName'];
        $billItem->unit_price = $item['price'];
        $billItem->quantity = $item['quantity'];
        $billItem->total_price = $item['total'];
        $billItem->store_id = $storeId;
        $billItem->waiter_id = $staffId;
        $billItem->save();

        //Update Bill Amount
        $bill = Bill::find($bill->id);
        $bill->bill_amount = BillItem::where('bill_id', $bill->id)->sum('total_price');
        $bill->save();
    }
}
