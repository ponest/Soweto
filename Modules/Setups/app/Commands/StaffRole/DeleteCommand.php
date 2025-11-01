<?php

namespace Modules\Setups\Commands\StaffRole;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\StaffRole;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = StaffRole::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Staff Role Successfully Deleted!',
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
