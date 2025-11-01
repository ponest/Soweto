<?php

namespace Modules\Inventory\Commands\StockRequisition;

use Exception;
use Modules\Inventory\Models\StockRequisition;
use Modules\Inventory\Models\StockRequisitionItem;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $stock_items = StockRequisitionItem::where('stock_requisition_id', $id)->count();
            if ($stock_items > 0) {
                $stockRequisition = StockRequisition::find($id);
                $stockRequisition->submitted_by = auth()->id();
                $stockRequisition->submitted_at = now();
                $stockRequisition->status = "Submitted";

                //Remove other states
                $stockRequisition->is_approved = null;
                $stockRequisition->reviewed_at = null;
                $stockRequisition->reviewed_by = null;
                $stockRequisition->reject_comments = null;

                $stockRequisition->update();
                //Sending Notification Back
                return [
                    'message' => 'Stock Requisition Successfully Submitted!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "You can't submit stock requisition now!, Please Fill Atleast one Item",
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
