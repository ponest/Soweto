<?php

namespace Modules\HotelMgnt\Commands\ClientWallet;

use Exception;
use Modules\HotelMgnt\Models\ClientWallet;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {

            $clientWallet = ClientWallet::find($id);
            $clientWallet->submitted_by = auth()->id();
            $clientWallet->submitted_at = now();
            $clientWallet->status = "Submitted";

            //Remove other states
            $clientWallet->is_approved = null;
            $clientWallet->reviewed_at = null;
            $clientWallet->reviewed_by = null;
            $clientWallet->reject_comments = null;

            $clientWallet->update();
            //Sending Notification Back
            return [
                'message' => 'Client Wallet Request Successfully Submitted!',
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
