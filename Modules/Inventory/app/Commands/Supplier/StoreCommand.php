<?php

namespace Modules\Inventory\Commands\Supplier;

use Modules\Inventory\Models\Supplier;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = Supplier::isExist($data['name']);
        if (!$isExist) {
            Supplier::create($data);
            //Sending Notification Back
            return [
                'message' => 'Supplier Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Supplier {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
