<?php

namespace Modules\Setups\Commands\Department;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\Department;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Department::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Department Successfully Deleted!',
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
