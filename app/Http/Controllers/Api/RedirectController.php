<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use App\Models\ClickHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DailyClickCount;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
public function redirect($custom_url)
    {
    // Find the link by the custom URL.
    $link = Link::where('short_url', $custom_url)->first();

    if ($link) {
        // Increment the click count (if tracking clicks).
        $link->increment('click_count');

        // Track click history.
        $this->storeClickHistory($link);

        // Track daily click counts.
        $this->storeDailyClickCount($link);

        // Return the destination URL as a JSON response.
        return response()->json([
            'success' => true,
            'destination_url' => $link->destination_url,
            'message' => 'Redirect successful.',
        ]);
    }

    // If the URL is not found, return a 404 response.
    return response()->json([
        'success' => false,
        'message' => 'Link not found!',
    ], 404);
}


/**
     * Store the click history for each click.
     *
     * @param Link $link
     */
    protected function storeClickHistory(Link $link)
    {
        ClickHistory::create([
            'link_id' => $link->id,
            'ip_address' => request()->ip(),
            'clicked_at' => now(),
        ]);
    }

    /**
     * Store the daily click count for the link.
     *
     * @param Link $link
     */
    protected function storeDailyClickCount(Link $link)
    {
        $date = Carbon::today();

        $dailyClickCount = DailyClickCount::where('link_id', $link->id)
            ->whereDate('click_date', $date)
            ->first();

        if ($dailyClickCount) {
            $dailyClickCount->increment('click_count');
        } else {
            DailyClickCount::create([
                'link_id' => $link->id,
                'click_date' => $date,
                'click_count' => 1,
            ]);
        }
    }

}
