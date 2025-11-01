<?php

namespace Modules\Inventory\Commands\StockRequisition;

use Exception;
use Modules\Inventory\Models\StockRequisition;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = StockRequisition::isExist($data['description']);
            if (!$isExist) {
                $data['requisition_number'] = 'REQ-' . now()->timestamp;
                $data['status'] = "Draft";
                $data['department_id'] = auth()->user()->department_id;

                //check if user has Store
                $storeId = auth()->user()->store_id;
                if ($storeId) {
                    $data['store_id'] = $storeId;
                    StockRequisition::create($data);
                    //Sending Notification Back
                    return [
                        'message' => 'Stock Requisition Successfully Created!',
                        'type' => 'success'
                    ];
                } else {
                    return [
                        'message' => "Failed to Create Item Stock, The Current user is not assigned to any store",
                        'type' => 'error'
                    ];
                }
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
