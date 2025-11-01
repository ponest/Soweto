<?php

namespace Modules\Sales\Commands\FoodMenu;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Sales\Models\FoodMenu;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = FoodMenu::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Food Menu Successfully Deleted!',
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
