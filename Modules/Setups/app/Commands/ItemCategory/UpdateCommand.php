<?php

namespace Modules\Setups\Commands\ItemCategory;
use Modules\Setups\Models\ItemCategory;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $identityType = ItemCategory::find($id);
        $isExist = ItemCategory::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $identityType->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Category Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Category {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
