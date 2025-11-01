<?php

namespace Modules\Auth\Commands\Roles;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Auth\Models\Role;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Role::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Role Successfully Deleted!',
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
