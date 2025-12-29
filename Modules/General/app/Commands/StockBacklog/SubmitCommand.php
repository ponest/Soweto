<?php

namespace Modules\General\Commands\StockBacklog;

use Exception;
use Modules\General\Models\StockBacklogRequest;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $backlogReq = StockBacklogRequest::find($id);
            $backlogReq->submitted_by = auth()->id();
            $backlogReq->submitted_at = now();
            $backlogReq->status = "Submitted";

            //Remove other states
            $backlogReq->is_approved = null;
            $backlogReq->reviewed_by = null;
            $backlogReq->reviewed_at = null;
            $backlogReq->reject_comments = null;

            $backlogReq->update();
            //Sending Notification Back
            return [
                'message' => 'Backlog Request Successfully Submitted!',
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
