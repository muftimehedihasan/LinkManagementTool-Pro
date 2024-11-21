<?php
namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LinkController extends Controller
{
    public function index()
    {
        // Paginate the links with 10 items per page
        // $links = Link::paginate(5);
        $links = Link::orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }



    // Method for Stor Data

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
            'short_url' => $validatedData['custom_url'] ?? substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8),
            'tags' => $validatedData['tags'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('links.index')->with('success', 'Link created successfully!');
    }





    public function edit(Link $link)
    {
        // Directly return the edit view with the link data
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'destination_url' => 'required|url',
            'custom_url' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        $link = Link::findOrFail($id);
        $link->destination_url = $request->destination_url;
        $link->short_url = $request->custom_url ?? $link->short_url; // Update if provided
        $link->tags = $request->tags;
        $link->save();

        return redirect()->route('dashboard')->with('success', 'Link updated successfully!');
        // return redirect()->back()->with('success', 'Link updated successfully!');
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
