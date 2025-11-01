<?php

namespace Modules\HotelMgnt\Commands\Client;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Client;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $client = Client::find($id);
            $isExist = Client::isExistOnEdit($data['name'], $data['phone_number'], $id);
            if (!$isExist) {
                $client->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Client Successfully Updated',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Client {$data['name']} with phone number {$data['phone_number']} Already Exist!",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }

    }
}
