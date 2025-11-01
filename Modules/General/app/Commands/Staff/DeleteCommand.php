<?php

namespace Modules\General\Commands\Staff;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\Staff;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Staff::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Staff Successfully Deleted!',
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
