<?php

namespace Modules\Sales\Commands\MenuPriceApproval;

use Exception;
use Modules\Sales\Models\MenuPriceApproval;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = MenuPriceApproval::isExist($data['description']);
            if (!$isExist) {
                $data['request_number'] = 'PAR-' . now()->timestamp;
                $data['status'] = "Draft";

                MenuPriceApproval::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Food Menu Request Successfully Created!',
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
