<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class RedirectController extends Controller
{
    public function redirect($custom_url)
    {
        // Find the link by the custom URL.
        $link = Link::where('short_url', $custom_url)->first();

        if ($link) {
            // Increment the click count (if tracking clicks).
            $link->increment('click_count');

            // Redirect to the destination URL.
            return redirect($link->destination_url);
        }

        // If the URL is not found, redirect to a 404 page or home.
        return redirect('/')->with('error', 'Link not found!');
    }



    // public function redirect($short_url)
    // {
    //     // Remove the prefix from the short URL
    //     $cleaned_short_url = str_replace('original-', '', $short_url);

    //     // Find the link in the database
    //     $link = Link::where('short_url', $cleaned_short_url)->firstOrFail();

    //     // Log the destination URL for debugging
    //     // Log::info('Redirecting to URL: ' . $link->destination_url);

    //     // Increment the click count
    //     $link->increment('click_count');

    //     // Redirect to the destination URL
    //     return redirect()->to($link->destination_url);
    // }
}
