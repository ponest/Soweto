<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Auth\Models\User;
use Modules\Sales\Models\Bill;

class SaveBillCommand
{
    public static function handle($sale_batch, $grandTotal, $booking): Bill
    {
        $departmentId = User::currentUserDepartmentId();
        $bill = new Bill();
        $bill->reference_no = "BILL-" . now()->timestamp;
        $bill->ref_id = $sale_batch->id;
        $bill->category = "Sales";
        $bill->bill_amount = $grandTotal;
        $bill->issued_by = auth()->id();
        $bill->issued_at = now();
        $bill->department_id = $departmentId;
        if ($booking != null) {
            $bill->booking_id = $booking->id;
        }
        $bill->save();
        return $bill;
    }
}
