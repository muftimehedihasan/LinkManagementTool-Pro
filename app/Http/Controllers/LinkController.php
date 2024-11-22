<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{


    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform search using Scout/Meilisearch
        $links = Link::search($query)->paginate(5);

        return view('dashboard', compact('links', 'query'));
    }



    /**
     * Display a listing of the user's links.
     */
    public function index()
    {
        $links = Link::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new link.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created link in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'destination_url' => 'required|url',
            'custom_url' => 'nullable|string|unique:links,short_url',
            'tags' => 'nullable|string',
        ], [
            'custom_url.unique' => 'The custom URL is already in use. Please choose a different one.',
        ]);

        $link = Link::create([
            'destination_url' => $validatedData['destination_url'],
            'short_url' => $validatedData['custom_url']
                ?? substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 6),
            'tags' => $validatedData['tags'],
            'user_id' => Auth::id(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Link created successfully!',
                'link' => $link
            ], 201);
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Link created successfully!');
    }



    public function show($id)
{
    $link = Link::findOrFail($id); // Retrieve the link by ID

    // Return the link details as JSON
    return response()->json([
        'success' => true,
        'data' => $link,
        'message' => 'Link retrieved successfully!',
    ], 200);
}




    public function edit($id)
    {
        // Retrieve the link by ID
        // dd($id);
        // Find the Link model by ID
        $link = Link::findOrFail($id);

        // Pass the retrieved Link model to the view
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        // Validate the request inputs
        $request->validate([
            'destination_url' => 'required|url',
            'custom_url' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        // Find the Link model by ID
        $link = Link::findOrFail($id);

        // Update the link's properties
        $link->destination_url = $request->destination_url;
        $link->short_url = $request->custom_url ?? $link->short_url; // Use provided custom URL or keep existing
        $link->tags = $request->tags;

        // Save the updated link to the database
        $link->save();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Updated successfully!');
    }



    /**
     * Remove the specified link from storage.
     */
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

        // Log the destination URL for debugging
        Log::info('Redirecting to URL: ' . $link->destination_url);

        // Increment the click count
        $link->increment('click_count');

        // Redirect to the destination URL
        return redirect()->to($link->destination_url);
    }



    // public function redirect($short_url)
    // {
    //     // Remove the prefix from the short URL
    //     $cleaned_short_url = str_replace('original-', '', $short_url);

    //     // Find the link in the database
    //     $link = Link::where('short_url', $cleaned_short_url)->firstOrFail();

    //     // Log the destination URL for debugging
    //     Log::info('Redirecting to URL: ' . $link->destination_url);

    //     // Increment the click count
    //     $link->increment('click_count');

    //     // Redirect to the destination URL
    //     return redirect()->to($link->destination_url);
    // }


}
