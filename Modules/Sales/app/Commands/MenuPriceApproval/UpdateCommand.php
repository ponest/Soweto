<?php

namespace Modules\Sales\Commands\MenuPriceApproval;

use Exception;
use Modules\Sales\Models\MenuPriceApproval;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $menuApproval = MenuPriceApproval::find($id);
            $isExist = MenuPriceApproval::isExistOnEdit($data['description'], $id);
            if (!$isExist) {
                $menuApproval->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Menu Price Request Successfully Updated',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Description Already Exist!",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }

    }
}
