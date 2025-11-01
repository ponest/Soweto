<?php

namespace Modules\Sales\Commands\MenuPriceApproval;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Models\MenuPrice;
use Modules\Sales\Models\MenuPriceApproval;
use Modules\Sales\Models\MenuPriceApprovalItem;

class ApproveCommand
{
    public static function handle($id): array
    {
        DB::beginTransaction();

        try {
            //check if there are items
            $priceApproval = MenuPriceApproval::findOrFail($id);
            $priceApproval->reviewed_by = auth()->id();
            $priceApproval->reviewed_at = now();
            $priceApproval->is_approved = true;
            $priceApproval->status = "Approved";
            $priceApproval->save();

            //Feed Data to Price Table
            $priceItems = MenuPriceApprovalItem::whereMenuPriceApprovalId($id)->get();
            foreach ($priceItems as $priceItem) {
                // check if active price exists
                $itemExist = MenuPrice::where('menu_id', $priceItem->menu_id)
                    ->where('is_active', true)
                    ->first();

                if ($itemExist) {
                    // deactivate current active price
                    $itemExist->is_active = false;
                    $itemExist->save();
                }

                // insert new active price
                $menuPrice = new MenuPrice();
                $menuPrice->menu_id = $priceItem->menu_id;
                $menuPrice->price = $priceItem->price;
                $menuPrice->is_active = true;
                $menuPrice->save();
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
