<?php

namespace Modules\Sales\Commands\MenuPriceApproval;

use Exception;
use Modules\Sales\Models\MenuPriceApproval;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $priceApproval = MenuPriceApproval::find($id);
            $priceApproval->reviewed_by = auth()->id();
            $priceApproval->reviewed_at = now();
            $priceApproval->is_approved = false;
            $priceApproval->status = "Rejected";
            $priceApproval->reject_comments = $data['reject_comments'];

            //Undo Submission
            $priceApproval->submitted_by = null;
            $priceApproval->submitted_at = null;

            //Update
            $priceApproval->update();
            //Sending Notification Back
            return [
                'message' => 'Price Request Successfully Rejected!',
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
