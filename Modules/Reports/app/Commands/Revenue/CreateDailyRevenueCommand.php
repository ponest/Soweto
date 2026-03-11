<?php

namespace Modules\Reports\Commands\Revenue;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Reports\Models\DailyRevenue;
use Modules\Sales\Models\Payment;
use Modules\Setups\Models\PaymentMethod;

class CreateDailyRevenueCommand
{
    public static function handle(): void
    {
        Log::info("Start CreateDailyRevenueCommand");

        $date = Carbon::yesterday();

        $totals = Payment::whereDate('created_at', $date)
            ->select(
                DB::raw('DATE(created_at) as date'),
                'payment_method_id',
                DB::raw('SUM(paid_amount) as total')
            )
            ->groupBy('date', 'payment_method_id')
            ->get();

        foreach ($totals as $row) {
            $paymentMethod = PaymentMethod::find($row->payment_method_id)->name;
            $date = Carbon::parse($row->date);

            DailyRevenue::updateOrCreate(
                [
                    'date' => $date->format('Y-m-d'),
                    'payment_method_id' => $row->payment_method_id
                ],
                [
                    'payment_method' => $paymentMethod,
                    'day' => $date->format('d'),
                    'month' => $date->format('m'),
                    'year' => $date->format('Y'),
                    'amount' => $row->total
                ]
            );
        }

        Log::info("Daily Revenue Created");
    }
}
