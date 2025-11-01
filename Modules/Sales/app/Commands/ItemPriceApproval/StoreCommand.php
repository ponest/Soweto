<?php

namespace Modules\Sales\Commands\ItemPriceApproval;

use Exception;
use Modules\Sales\Models\ItemPriceApproval;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = ItemPriceApproval::isExist($data['description']);
            if (!$isExist) {
                $data['request_number'] = 'PAR-' . now()->timestamp;
                $data['status'] = "Draft";

                ItemPriceApproval::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Item Price Request Successfully Created!',
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
