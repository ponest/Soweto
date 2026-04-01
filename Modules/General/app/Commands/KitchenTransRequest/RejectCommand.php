<?php

namespace Modules\General\Commands\KitchenTransRequest;

use Exception;
use Modules\General\Models\KitchenTransReq;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $kitchenReq = KitchenTransReq::find($id);
            $kitchenReq->reviewed_by = auth()->id();
            $kitchenReq->reviewed_at = now();
            $kitchenReq->is_approved = false;
            $kitchenReq->status = "Rejected";
            $kitchenReq->reject_comments = $data['reject_comments'];

            //Undo Submission
            $kitchenReq->submitted_by = null;
            $kitchenReq->submitted_at = null;

            //Update
            $kitchenReq->update();
            //Sending Notification Back
            return [
                'message' => 'Kitchen Trans Request Successfully Rejected!',
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
