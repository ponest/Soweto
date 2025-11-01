<?php

namespace Modules\Inventory\Commands\StockRequisition;

use Exception;
use Modules\Inventory\Models\StockRequisition;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $stockRequisition = StockRequisition::find($id);
            $isExist = StockRequisition::isExistOnEdit($data['description'], $id);
            if (!$isExist) {
                $stockRequisition->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Stock Requisition Successfully Updated',
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
