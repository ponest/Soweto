<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\DiscountReq;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = DiscountReq::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Discount Request Successfully Deleted!',
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
