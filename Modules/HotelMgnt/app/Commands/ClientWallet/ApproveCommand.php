<?php

namespace Modules\HotelMgnt\Commands\clientWallet;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\HotelMgnt\Models\ClientWallet;

class ApproveCommand
{
    public static function handle($id): array
    {
        DB::beginTransaction();

        try {
            //check if there are items
            $priceApproval = ClientWallet::findOrFail($id);
            $priceApproval->reviewed_by = auth()->id();
            $priceApproval->reviewed_at = now();
            $priceApproval->is_approved = true;
            $priceApproval->status = "Approved";
            $priceApproval->save();

            DB::commit();

            return [
                'message' => 'Client Wallet Request Successfully Approved!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            DB::rollBack();

            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
