<?php

namespace Modules\HotelMgnt\Commands\AdvancePayment;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\AdvancePayment;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $advancePayment = AdvancePayment::find($id);
            $advancePayment->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Advance Payment Successfully Updated',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}
