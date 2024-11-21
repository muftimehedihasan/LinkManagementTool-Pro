<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
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

}
