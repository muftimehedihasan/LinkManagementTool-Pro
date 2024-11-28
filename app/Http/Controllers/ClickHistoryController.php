<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\ClickHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DailyClickCount;
use Illuminate\Support\Facades\DB;

class ClickHistoryController extends Controller
{
    /**
     * Display a listing of click histories for a specific link.
     */
    // public function index($linkId)
    // {
    //     // Fetch the link and its click histories
    //     $link = Link::with('clickHistories')->findOrFail($linkId);

    //     return view('click_histories.index', compact('link'));
    // }

    public function recordClick($linkId, $userId = null, $ipAddress = null)
    {
        // Step 1: Log the individual click
        ClickHistory::create([
            'link_id' => $linkId,
            // 'user_id' => $userId,
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

        return response()->json(['message' => 'Click recorded successfully.']);
    }



    public function index($linkId)
{
    $link = Link::with('clickHistories')->findOrFail($linkId);

    $dailyClickCounts = DB::table('daily_click_counts')
        ->where('link_id', $linkId)
        ->orderBy('click_date', 'desc')
        ->get();

    return view('click_histories.index', compact('link', 'dailyClickCounts'));
}




// method for chart indivusal link

public function getChartData($link_id, Request $request)
    {
        // Fetch the date range from request
        $range = $request->get('range', 'last7days');
        $query = DailyClickCount::where('link_id', $link_id);

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
            'dates' => $data->pluck('click_date'),       // X-axis
            'clicks' => $data->pluck('click_count'),    // Y-axis
        ];

        return response()->json($chartData);
    }



}
