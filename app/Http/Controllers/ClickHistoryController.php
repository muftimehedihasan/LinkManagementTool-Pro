<?php

namespace App\Http\Controllers;

use App\Models\ClickHistory;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClickHistoryController extends Controller
{
    /**
     * Handle a click on a link and record it in the click history.
     *
     * @param string $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function trackClick($shortUrl)
    {
        // Find the link by short URL
        $link = Link::where('short_url', $shortUrl)->first();

        if (!$link) {
            // If link not found, return 404
            return abort(404, 'Link not found');
        }

        // Record the click in the click_histories table
        ClickHistory::create([
            'link_id' => $link->id,
            'user_id' => Auth::check() ? Auth::id() : null,  // If logged in, save the user ID, else null
            'ip_address' => request()->ip(),  // Get the user's IP address
            'clicked_at' => now(),  // Set the timestamp to now
        ]);

        // Optionally, you can increment the click count in the links table
        $link->increment('click_count');

        // Redirect the user to the destination URL of the link
        return Redirect::to($link->destination_url);
    }

    /**
     * Display the click history of a specific link.
     *
     * @param string $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function showClickHistory($shortUrl)
    {
        // Find the link by short URL
        $link = Link::where('short_url', $shortUrl)->first();

        if (!$link) {
            // If link not found, return 404
            return abort(404, 'Link not found');
        }

        // Get the click history for the link
        $clickHistories = $link->clickHistories()->get();

        // Return a view with the click history (you can customize this view)
        return view('click_history.index', compact('link', 'clickHistories'));
    }
}
