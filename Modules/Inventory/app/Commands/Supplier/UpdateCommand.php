<?php

namespace Modules\Inventory\Commands\Supplier;

use Modules\Inventory\Models\Supplier;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $supplier = Supplier::find($id);
        $isExist = Supplier::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $supplier->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Supplier Successfully Updated',
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
