<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\ClickHistory;
use Illuminate\Http\Request;
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
            'user_id' => $userId,
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


}
