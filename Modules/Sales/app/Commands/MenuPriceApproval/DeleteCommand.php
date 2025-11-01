<?php

namespace Modules\Sales\Commands\MenuPriceApproval;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Sales\Models\MenuPriceApproval;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = MenuPriceApproval::find($id);
            $item->delete();

            //Delete Approval Items
            $item->menuPriceItems()->delete();

            //Sending Back Notification
            return [
                'message' => 'Menu Price Request Successfully Deleted!',
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
