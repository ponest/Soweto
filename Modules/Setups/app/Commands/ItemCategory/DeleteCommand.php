<?php

namespace Modules\Setups\Commands\ItemCategory;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\ItemCategory;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = ItemCategory::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Category Successfully Deleted!',
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
