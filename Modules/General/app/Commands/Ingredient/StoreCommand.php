<?php

namespace Modules\General\Commands\Ingredient;
use Modules\General\Models\Ingredient;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = Ingredient::isExist($data['menu_id'],$data['stock_item_id']);
        if (!$isExist) {
            Ingredient::create($data);
            //Sending Notification Back
            return [
                'message' => 'Ingredient Successfully Created!',
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
