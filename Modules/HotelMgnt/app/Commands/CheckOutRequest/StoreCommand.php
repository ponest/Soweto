<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;
use Modules\HotelMgnt\Models\CheckOutRequest;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = CheckOutRequest::isExist($data['booking_id']);
        if (!$is_exist) {
            $data['submitted_at'] = now();
            $data['submitted_by'] = auth()->id();
            $data['status'] = 'submitted';
            $data['request_number'] = 'CHK-REQ-'.now()->timestamp;
            CheckOutRequest::create($data);
            //Sending Notification Back
            return [
                'message' => 'CheckOut Request Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Checkout request for this booking already Exist!",
                'type' => 'error'
            ];
        }
    }
}
