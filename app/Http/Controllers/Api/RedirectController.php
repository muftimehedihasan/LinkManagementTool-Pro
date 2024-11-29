<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use Illuminate\Http\Request;
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

        // // Track click history.
        // $this->storeClickHistory($link);

        // // Track daily click counts.
        // $this->storeDailyClickCount($link);

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

}
