<?php

namespace Modules\Setups\Commands\IdentityType;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\IdentityType;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = IdentityType::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Identity Type Successfully Deleted!',
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
