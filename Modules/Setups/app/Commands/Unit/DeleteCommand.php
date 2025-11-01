<?php

namespace Modules\Setups\Commands\Unit;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\Unit;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Unit::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Unit Successfully Deleted!',
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
