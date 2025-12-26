<?php

namespace Modules\General\Commands\Ingredient;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\Ingredient;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Ingredient::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Ingredient Successfully Deleted!',
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
