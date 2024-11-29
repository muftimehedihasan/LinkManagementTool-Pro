<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use App\Models\ClickHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DailyClickCount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClickHistoryController extends Controller
{
     /**
     * Record a click and update click history and daily click count.
     *
     * @param int $linkId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordClick($linkId, Request $request)
    {
        $ipAddress = $request->ip(); // Use request IP if not provided
        $userId = $request->user() ? $request->user()->id : null;

        // Step 1: Log the individual click
        ClickHistory::create([
            'link_id' => $linkId,
            'ip_address' => $ipAddress,
            'clicked_at' => now(),
        ]);

        // Step 2: Update or insert the daily click count
        DB::table('daily_click_counts')->updateOrInsert(
            [
                'link_id' => $linkId,
                'click_date' => now()->toDateString(),
            ],
            [
                'click_count' => DB::raw('click_count + 1'),
                'updated_at' => now(),
            ]
        );

        return response()->json(['message' => 'Click recorded successfully.'], 200);
    }

    /**
     * Get daily click counts for a specific link.
     *
     * @param int $linkId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClickHistory($linkId)
    {
        $link = Link::with('clickHistories')->findOrFail($linkId);

        $dailyClickCounts = DB::table('daily_click_counts')
            ->where('link_id', $linkId)
            ->orderBy('click_date', 'desc')
            ->get();

        return response()->json([
            'link' => $link,
            'daily_click_counts' => $dailyClickCounts,
        ]);
    }

    /**
     * Get chart data for an individual link.
     *
     * @param int $linkId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData($linkId, Request $request)
    {
        // Fetch the date range from the request
        $range = $request->get('range', 'last7days');
        $query = DailyClickCount::where('link_id', $linkId);

        // Apply date filtering based on range
        if ($range === 'today') {
            $query->where('click_date', Carbon::today()->toDateString());
        } elseif ($range === 'last7days') {
            $query->where('click_date', '>=', Carbon::today()->subDays(7)->toDateString());
        } elseif ($range === 'last30days') {
            $query->where('click_date', '>=', Carbon::today()->subDays(30)->toDateString());
        }

        // Get data grouped by date
        $data = $query->orderBy('click_date')->get();

        // Prepare chart data
        $chartData = [
            'dates' => $data->pluck('click_date')->map(fn($date) => date('d F', strtotime($date))), // X-axis
            'clicks' => $data->pluck('click_count'), // Y-axis
        ];

        return response()->json($chartData);
    }
}
