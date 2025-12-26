<?php

namespace Modules\HotelMgnt\Commands\AdvancePayment;

use Exception;
use Modules\HotelMgnt\Models\AdvancePayment;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $data['reference_number'] = 'ADV-'.now()->timestamp;
            $data['created_by'] = auth()->id();
            AdvancePayment::create($data);
            //Sending Notification Back
            return [
                'message' => 'Advance Payment Successfully Created!',
                'type' => 'success'
            ];

        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
