<?php

namespace Modules\General\Commands\Ingredient;

use Modules\General\Models\Ingredient;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $ingredient = Ingredient::find($id);
        $isExist = Ingredient::isExistOnEdit($ingredient->menu_id,$data['stock_item_id'],$id);
        if (!$isExist) {
            $ingredient->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Ingredient Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Ingredient Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
