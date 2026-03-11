<?php

namespace Modules\Reports\Queries\Revenue;


use Illuminate\Support\Carbon;
use Modules\Reports\Models\DailyRevenue;

class WeeklyRevenueQuery
{
    public static function handle(): array
    {
        $revenues = DailyRevenue::selectRaw('DATE(date) as day, SUM(amount) as total_revenue')
            ->whereDate('date', '>=', Carbon::now()->subDays(6))
            ->groupByRaw('DATE(date)')
            ->orderBy('day')
            ->get();

        $dates = [];
        $amounts = [];

        foreach ($revenues as $rev) {
            $dates[] = Carbon::parse($rev->day)->format('D');
            $amounts[] = (float)$rev->total_revenue;
        }

        return [
            'dates' => $dates,
            'amounts' => $amounts
        ];
    }
}
