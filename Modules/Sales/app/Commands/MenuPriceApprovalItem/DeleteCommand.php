<?php

namespace Modules\Sales\Commands\MenuPriceApprovalItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Sales\Models\MenuPriceApprovalItem;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = MenuPriceApprovalItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Price Approval Item Successfully Deleted!',
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
