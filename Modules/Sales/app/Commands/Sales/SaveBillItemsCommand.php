<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Inventory\Models\Store;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\BillItem;

class SaveBillItemsCommand
{
    public static function handle($bill, $item, $storeId, $staffId): void
    {
        $billItem = new BillItem();
        $billItem->bill_id = $bill->id;
        $billItem->item_name = $item['itemName'];
        $billItem->unit_price = $item['price'];
        $billItem->quantity = $item['quantity'];
        $billItem->total_price = $item['total'];
        $billItem->store_id = $storeId;
        $billItem->waiter_id = $staffId;
        $store = Store::find($storeId);
        if ($store) {
            $billItem->bill_source = $store->name;
        } else {
            $billItem->bill_source = "Not Defined";
        }
        $billItem->save();

        //Update Bill Amount
        $bill = Bill::find($bill->id);
        $bill->bill_amount = BillItem::where('bill_id', $bill->id)->sum('total_price');
        $bill->save();
    }
}
