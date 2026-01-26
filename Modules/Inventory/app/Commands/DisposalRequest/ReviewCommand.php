<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Modules\Inventory\Models\DisposalRequest;

class ReviewCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $disposalRequest = DisposalRequest::find($id);
            $disposalRequest->reviewed_by = auth()->id();
            $disposalRequest->reviewed_at = now();
            $disposalRequest->status = "Reviewed";
            $disposalRequest->update();
            //Sending Notification Back
            return [
                'message' => 'Disposal Request Successfully Reviewed!',
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
