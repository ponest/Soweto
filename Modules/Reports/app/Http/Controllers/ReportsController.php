<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Reports\Models\DailyRevenue;
use Modules\Sales\Models\Payment;

class ReportsController extends Controller
{

//    public function revenueTrend()
//    {
//        $revenues = DB::table('daily_revenues')
//            ->select(
//                DB::raw('DATE(date) as day'),
//                DB::raw('SUM(amount) as total_revenue')
//            )
//            ->whereDate('date', '>=', Carbon::now()->subDays(6))
//            ->groupBy('day')
//            ->orderBy('day')
//            ->get();
//
//        $dates = [];
//        $amounts = [];
//
//        foreach ($revenues as $rev) {
//            $dates[] = Carbon::parse($rev->day)->format('D');
//            $amounts[] = (float) $rev->total_revenue;
//        }
//
//        return view('reports.revenue-trend', compact('dates','amounts'));
//    }

//    public function calculateDailyRevenue()
//    {
//        $date = Carbon::yesterday();
//
//        $totals = Payment::whereDate('created_at', $date)
//            ->select(
//                DB::raw('DATE(created_at) as date'),
//                'payment_method_id',
//                DB::raw('SUM(paid_amount) as total')
//            )
//            ->groupBy('date','payment_method_id')
//            ->get();
//
//        foreach ($totals as $row) {
//
//            $date = Carbon::parse($row->date);
//
//            DailyRevenue::updateOrCreate(
//                [
//                    'date' => $date->format('Y-m-d'),
//                    'payment_method_id' => $row->payment_method_id
//                ],
//                [
//                    'day' => $date->format('d'),
//                    'month' => $date->format('m'),
//                    'year' => $date->format('Y'),
//                    'amount' => $row->total
//                ]
//            );
//        }
//
//        return response()->json([
//            'success' => true,
//            'totals' => $totals,
//            'message' => 'Success'
//        ]);
//    }


}
