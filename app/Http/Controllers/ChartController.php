<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getChartData()
    {
        // Get data for the last 7 days
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(6);

        $dailyClicks = Link::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(click_count) as total_clicks')
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Calculate total clicks and percentage change
        $totalClicks = $dailyClicks->sum('total_clicks');
        $previousPeriodClicks = Link::whereBetween('created_at', [
            $startDate->copy()->subDays(7),
            $endDate->copy()->subDays(7)
        ])->sum('click_count');

        $percentageChange = $previousPeriodClicks > 0
            ? (($totalClicks - $previousPeriodClicks) / $previousPeriodClicks) * 100
            : 0;

        // Prepare data for the chart
        $dates = [];
        $clicks = [];

        // Initialize arrays with 0 for all dates
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i)->format('d M');
            $dates[] = $date;
            $clicks[$date] = 0;
        }

        // Fill in actual data
        foreach ($dailyClicks as $daily) {
            $date = Carbon::parse($daily->date)->format('d M');
            $clicks[$date] = $daily->total_clicks;
        }

        return response()->json([
            'dates' => $dates,
            'clicks' => array_values($clicks),
            'total_clicks' => $totalClicks,
            'percentage_change' => round($percentageChange, 1)
        ]);
    }
}
