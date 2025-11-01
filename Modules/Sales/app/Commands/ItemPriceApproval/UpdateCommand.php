<?php

namespace Modules\Sales\Commands\ItemPriceApproval;

use Exception;
use Modules\Sales\Models\ItemPriceApproval;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $priceApproval = ItemPriceApproval::find($id);
            $isExist = ItemPriceApproval::isExistOnEdit($data['description'], $id);
            if (!$isExist) {
                $priceApproval->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Item Price Request Successfully Updated',
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
