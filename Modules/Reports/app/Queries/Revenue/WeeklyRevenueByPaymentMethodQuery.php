<?php

namespace Modules\Reports\Queries\Revenue;

use Illuminate\Support\Carbon;
use Modules\Reports\Models\DailyRevenue;

class WeeklyRevenueByPaymentMethodQuery
{
    public static function handle(): array
    {
        $revenues = DailyRevenue::selectRaw('DATE(date) as day, payment_method, SUM(amount) as total')
            ->whereDate('date', '>=', Carbon::now()->subDays(6))
            ->groupByRaw('DATE(date), payment_method')
            ->orderBy('day')
            ->get();

        $dates = [];
        $series = [];

        foreach ($revenues as $rev) {

            $day = Carbon::parse($rev->day)->format('D');
            $method = $rev->payment_method;

            if (!in_array($day, $dates)) {
                $dates[] = $day;
            }

            $series[$method][$day] = (float)$rev->total;
        }

        $chartSeries = [];

        foreach ($series as $method => $data) {

            $values = [];

            foreach ($dates as $d) {
                $values[] = $data[$d] ?? 0;
            }

            $chartSeries[] = [
                'name' => $method,
                'data' => $values
            ];
        }

        return [
            'dates' => $dates,
            'series' => $chartSeries
        ];
    }
}
