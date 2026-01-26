<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Modules\Auth\Models\User;
use Modules\Inventory\Models\DisposalRequest;

class StoreCommand
{
    public static function handle($data): array
    {
        try {

            $data['request_number'] = 'DISP-' . now()->timestamp;
            $data['status'] = "Draft";
            $data['store_id'] = User::userStoreId();
            DisposalRequest::create($data);
            //Sending Notification Back
            return [
                'message' => 'Disposal Request Successfully Created!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
