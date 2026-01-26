<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Modules\Inventory\Models\DisposalRequest;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $disposalRequest = DisposalRequest::find($id);
            $disposalRequest->reviewed_by = auth()->id();
            $disposalRequest->reviewed_at = now();
            $disposalRequest->is_approved = false;
            $disposalRequest->status = "Rejected";
            $disposalRequest->reject_comments = $data['reject_comments'];

            //Undo Submission
            $disposalRequest->submitted_by = null;
            $disposalRequest->submitted_at = null;

            //Update
            $disposalRequest->update();
            //Sending Notification Back
            return [
                'message' => 'Disposal Request Successfully Rejected!',
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
