<?php

namespace Modules\HotelMgnt\Commands\AdvancePayment;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\AdvancePayment;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = AdvancePayment::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Advance Payment Successfully Deleted!',
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
