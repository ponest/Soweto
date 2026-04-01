<?php

namespace Modules\General\Commands\KitchenTransRequest;

use Exception;
use Modules\General\Models\KitchenTransReq;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $kitchenRequest = KitchenTransReq::find($id);
            $kitchenRequest->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Kitchen Transaction Request Successfully Updated',
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
