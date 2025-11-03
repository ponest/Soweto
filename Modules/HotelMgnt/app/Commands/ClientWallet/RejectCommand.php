<?php

namespace Modules\HotelMgnt\Commands\ClientWallet;

use Exception;
use Modules\HotelMgnt\Models\ClientWallet;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $clientWallet = ClientWallet::find($id);
            $clientWallet->reviewed_by = auth()->id();
            $clientWallet->reviewed_at = now();
            $clientWallet->is_approved = false;
            $clientWallet->status = "Rejected";
            $clientWallet->reject_comments = $data['reject_comments'];

            //Undo Submission
            $clientWallet->submitted_by = null;
            $clientWallet->submitted_at = null;

            //Update
            $clientWallet->update();
            //Sending Notification Back
            return [
                'message' => 'Client Wallet Request Successfully Rejected!',
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
