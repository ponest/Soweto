<?php

namespace Modules\Sales\Commands\FoodMenu;
use Modules\Sales\Models\FoodMenu;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = FoodMenu::isExist($data['name']);
        if (!$isExist) {
            FoodMenu::create($data);
            //Sending Notification Back
            return [
                'message' => 'Food Menu Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Menu with name {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}
