<?php
namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index()
    {
        // Paginate the links with 10 items per page
        $links = Link::paginate(5);
        return view('dashboard', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate(['original_url' => 'required|url']);

        $shortUrl = Str::random(6); // Generate a 6-character unique code

        Link::create([
            'original_url' => $request->original_url,
            'short_url' => $shortUrl,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('links.index')->with('success', 'Short link created successfully!');
    }

    public function edit(Link $link)
    {
        // Directly return the edit view with the link data
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        // Validate the incoming request
        $request->validate(['original_url' => 'required|url']);

        // Update the link's original URL
        $link->update(['original_url' => $request->original_url]);

        // Redirect back to the index page with a success message
        return redirect()->route('links.index')->with('success', 'Link updated successfully!');
    }


    public function destroy(Link $link)
    {
        // Delete the link
        $link->delete();

        // Return a JSON response with success status
        return response()->json(['success' => true]);
    }


    public function redirect($short_url)
    {
        $link = Link::where('short_url', $short_url)->firstOrFail();
        $link->increment('click_count');

        return redirect($link->original_url);
    }
}
