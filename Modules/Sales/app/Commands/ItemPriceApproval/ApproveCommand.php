<?php

namespace Modules\Sales\Commands\ItemPriceApproval;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Models\ItemPrice;
use Modules\Sales\Models\ItemPriceApproval;
use Modules\Sales\Models\PriceApprovalItem;

class ApproveCommand
{
    public static function handle($id): array
    {
        DB::beginTransaction();

        try {
            //check if there are items
            $priceApproval = ItemPriceApproval::findOrFail($id);
            $priceApproval->reviewed_by = auth()->id();
            $priceApproval->reviewed_at = now();
            $priceApproval->is_approved = true;
            $priceApproval->status = "Approved";
            $priceApproval->save();

            //Feed Data to Price Table
            $priceItems = PriceApprovalItem::wherePriceApprovalId($id)->get();
            foreach ($priceItems as $priceItem) {
                // check if active price exists
                $itemExist = ItemPrice::where('item_id', $priceItem->item_id)
                    ->where('is_active', true)
                    ->first();

                if ($itemExist) {
                    // deactivate current active price
                    $itemExist->is_active = false;
                    $itemExist->save();
                }

                // insert new active price
                $itemPrice = new ItemPrice();
                $itemPrice->item_id = $priceItem->item_id;
                $itemPrice->price = $priceItem->price;
                $itemPrice->is_active = true;
                $itemPrice->save();
            }

            DB::commit();

            return [
                'message' => 'Price Request Successfully Approved!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            DB::rollBack();

            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
