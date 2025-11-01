<?php

namespace Modules\Sales\Commands\ItemPriceApproval;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Sales\Models\ItemPriceApproval;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = ItemPriceApproval::find($id);
            $item->delete();

            //Delete Approval Items
            $item->approvalItems()->delete();

            //Sending Back Notification
            return [
                'message' => 'Item Price Request Successfully Deleted!',
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
