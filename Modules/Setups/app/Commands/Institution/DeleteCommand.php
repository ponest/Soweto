<?php

namespace Modules\Setups\Commands\Institution;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\Institution;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Institution::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Institution Successfully Deleted!',
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
