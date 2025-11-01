<?php

namespace Modules\Inventory\Commands\StockRequisition;

use Exception;
use Modules\Inventory\Models\StockRequisition;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $stockRequisition = StockRequisition::find($id);
            $stockRequisition->reviewed_by = auth()->id();
            $stockRequisition->reviewed_at = now();
            $stockRequisition->is_approved = false;
            $stockRequisition->status = "Rejected";
            $stockRequisition->reject_comments = $data['reject_comments'];

            //Undo Submission
            $stockRequisition->submitted_by = null;
            $stockRequisition->submitted_at = null;

            //Update
            $stockRequisition->update();
            //Sending Notification Back
            return [
                'message' => 'Stock Requisition Successfully Rejected!',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }

    }
}
