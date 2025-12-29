<?php

namespace Modules\General\Commands\StockBacklog;

use Exception;
use Modules\Auth\Models\User;
use Modules\General\Models\StockBacklogRequest;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $data['request_number'] = 'BKL-' . now()->timestamp;
            $data['status'] = "Draft";
            $data['store_id'] = User::userStoreId();
            StockBacklogRequest::create($data);
            //Sending Notification Back
            return [
                'message' => 'Stock Backlog Request Successfully Created!',
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
