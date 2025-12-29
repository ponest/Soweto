<?php

namespace Modules\General\Commands\StockBacklog;

use Exception;
use Modules\General\Models\StockBacklogRequest;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $backlogReq = StockBacklogRequest::find($id);
            $backlogReq->reviewed_by = auth()->id();
            $backlogReq->reviewed_at = now();
            $backlogReq->is_approved = false;
            $backlogReq->status = "Rejected";
            $backlogReq->reject_comments = $data['reject_comments'];

            //Undo Submission
            $backlogReq->submitted_by = null;
            $backlogReq->submitted_at = null;

            //Update
            $backlogReq->update();
            //Sending Notification Back
            return [
                'message' => 'Stock Backlog Request Successfully Rejected!',
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
