<?php

namespace Modules\Inventory\Commands\Store;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\Store;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $store = Store::find($id);
            $isExist = Store::isExistOnEdit($data['name'], $id);
            if (!$isExist) {
                $store->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Store Successfully Updated',
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
