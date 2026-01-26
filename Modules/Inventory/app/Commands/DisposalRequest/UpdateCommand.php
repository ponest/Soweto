<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Modules\Inventory\Models\DisposalRequest;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $disposalRequest = DisposalRequest::find($id);
            $disposalRequest->update($data);

            //Sending Notification Back
            return [
                'message' => 'Disposal Request Successfully Updated',
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
