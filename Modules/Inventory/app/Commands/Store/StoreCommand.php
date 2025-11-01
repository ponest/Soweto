<?php

namespace Modules\Inventory\Commands\Store;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\Store;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = Store::isExist($data['name']);
            if (!$isExist) {
                Store::create($data);

                //Sending Notification Back
                return [
                    'message' => 'Store Successfully Created!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Store {$data['name']} Already Exist!",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}
