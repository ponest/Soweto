<?php

namespace Modules\Inventory\Commands\StockRequisition;

use Exception;
use Modules\Inventory\Models\StockRequisition;
use Modules\Inventory\Models\StockRequisitionItem;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $stock_items = StockRequisitionItem::where('stock_requisition_id', $id)->count();
            if ($stock_items > 0) {
                $stockRequisition = StockRequisition::find($id);
                $stockRequisition->reviewed_by = auth()->id();
                $stockRequisition->reviewed_at = now();
                $stockRequisition->is_approved = true;
                $stockRequisition->status = "Approved";
                $stockRequisition->update();
                //Sending Notification Back
                return [
                    'message' => 'Stock Requisition Successfully Approved!',
                    'type' => 'success'
                ];
            }else{
                return [
                    'message' => "You can't submit stock requisition now!, Please Fill At least one Item",
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
