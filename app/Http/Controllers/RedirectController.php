<?php
namespace App\Http\Controllers;

use id;
use Carbon\Carbon;
use App\Models\Link;
use App\Models\ClickHistory;
use Illuminate\Http\Request;
use App\Models\DailyClickCount;

class RedirectController extends Controller
{
    public function redirect($custom_url)
    {
        // Find the link by the custom URL.
        $link = Link::where('short_url', $custom_url)->first();

        if ($link) {
            // Increment the click count (if tracking clicks).
            $link->increment('click_count');

            // Track click history
            $this->storeClickHistory($link);

            // Track daily click counts
            $this->storeDailyClickCount($link);

            // Redirect to the destination URL.
            return redirect($link->destination_url);
        }

        // If the URL is not found, redirect to a 404 page or home.
        return redirect('/')->with('error', 'Link not found!');
    }

    /**
     * Store the click history for each click.
     *
     * @param Link $link
     */
    protected function storeClickHistory(Link $link)
    {
        // Create a new click history record
        ClickHistory::create([
            'link_id' => $link->id,
            // 'user_id' => auth()->check() ? auth()->id() : null,  // Store user ID if logged in, otherwise null
            'ip_address' => request()->ip(),  // Store the IP address of the user
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
        $date = Carbon::today(); // Get the current date

        // Check if the click count for this link today already exists
        $dailyClickCount = DailyClickCount::where('link_id', $link->id)
            ->whereDate('click_date', $date)
            ->first();

        if ($dailyClickCount) {
            // If the entry exists, increment the click count
            $dailyClickCount->increment('click_count');
        } else {
            // Otherwise, create a new daily click count record
            DailyClickCount::create([
                'link_id' => $link->id,
                'click_date' => $date,
                'click_count' => 1,  // Set the initial click count to 1
            ]);
        }
    }
}
