<?php

namespace Modules\Sales\Commands\FoodMenu;
use Modules\Sales\Models\FoodMenu;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $menu = FoodMenu::find($id);
        $isExist = FoodMenu::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $menu->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Menu Successfully Updated',
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
