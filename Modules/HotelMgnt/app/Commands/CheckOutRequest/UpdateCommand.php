<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;
use Modules\HotelMgnt\Models\CheckOutRequest;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $guest = CheckOutRequest::find($id);
        $guest->update($data);
        //Sending Notification Back to Roles
        return [
            'message' => 'Checkout Request Successfully Updated',
            'type' => 'success'
        ];

    }
}
