<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Modules\Inventory\Models\DisposalRequest;
use Modules\Inventory\Models\DisposalRequestItem;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $disposal_items = DisposalRequestItem::whereDisposalRequestId($id)->count();
            if ($disposal_items > 0) {
                $disposalRequest = DisposalRequest::find($id);
                $disposalRequest->submitted_by = auth()->id();
                $disposalRequest->submitted_at = now();
                $disposalRequest->status = "Submitted";

                //Remove other states
                $disposalRequest->is_approved = null;
                $disposalRequest->reviewed_at = null;
                $disposalRequest->reviewed_by = null;
                $disposalRequest->reject_comments = null;

                $disposalRequest->update();
                //Sending Notification Back
                return [
                    'message' => 'Disposal Request Successfully Submitted!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "You can't submit disposal request now!, Please Fill at-least one Item",
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
