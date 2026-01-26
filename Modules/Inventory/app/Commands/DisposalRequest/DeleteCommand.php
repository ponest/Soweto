<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\DisposalRequest;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = DisposalRequest::find($id);
            $item->delete();

            //Delete Related Models
            $item->disposalItems()->delete();

            //Sending Back Notification
            return [
                'message' => 'Disposal Request Successfully Deleted!',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}
