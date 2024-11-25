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

         return view('links.index', compact('links', 'query'));
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
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'destination_url' => 'required|url',
    //         'custom_url' => 'nullable|string|unique:links,short_url',
    //         'tags' => 'nullable|string',
    //     ], [
    //         'custom_url.unique' => 'The custom URL is already in use. Please choose a different one.',
    //     ]);

    //     $link = Link::create([
    //         'destination_url' => $validatedData['destination_url'],
    //         'short_url' => $validatedData['custom_url']
    //             ?? substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 6),
    //         'tags' => $validatedData['tags'],
    //         'user_id' => Auth::id(),
    //     ]);

    //     if ($request->expectsJson()) {
    //         return response()->json([
    //             'message' => 'Link created successfully!',
    //             'link' => $link
    //         ], 201);
    //     }

    //     return redirect()
    //         ->route('links.index')
    //         ->with('success', 'Link created successfully!');
    // }


//     public function store(Request $request)
// {
//     try {
//         // Validate the request inputs
//         $validatedData = $request->validate([
//             'destination_url' => 'required|url',
//             'custom_url' => 'nullable|string|unique:links,short_url',
//             'tags' => 'nullable|string',
//         ], [
//             'custom_url.unique' => 'The custom URL is already in use. Please choose a different one.',
//         ]);

//         // Create the new link
//         $link = Link::create([
//             'destination_url' => $validatedData['destination_url'],
//             'short_url' => $validatedData['custom_url']
//                 ?? substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 4), // Generate a random short URL
//             'tags' => $validatedData['tags'],
//             'user_id' => Auth::id(),
//         ]);

//         // Handle JSON requests
//         if ($request->expectsJson()) {
//             return response()->json([
//                 'message' => 'Link created successfully!',
//                 'link' => $link,
//             ], 201);
//         }

//         // Redirect to the link index with a success message
//         return redirect()
//             ->route('links.index')
//             ->with('success', 'Link created successfully!');
//     } catch (\Illuminate\Database\QueryException $e) {
//         // Check if the error is due to a unique constraint violation
//         if ($e->getCode() === '23000') {
//             return back()->withErrors([
//                 'custom_url' => 'The custom URL is already in use. Please choose a different one.'
//             ])->withInput();
//         }

//         // For other database errors, show a generic error message
//         return back()->withErrors([
//             'error' => 'An error occurred while creating the link. Please try again.'
//         ])->withInput();
//     } catch (\Exception $e) {
//         // Handle general exceptions
//         return back()->withErrors([
//             'error' => 'Something went wrong. Please try again.'
//         ])->withInput();
//     }
// }

public function store(Request $request)
{
    try {
        // Validate the request inputs
        $validatedData = $request->validate([
            'destination_url' => 'required|url',
            'custom_url' => 'nullable|string|unique:links,short_url',
            'tags' => 'nullable|string',
        ], [
            'custom_url.unique' => 'The custom URL is already in use. Please choose a different one.',
        ]);

        // Generate the short URL
        $shortUrl = $validatedData['custom_url']
            ?? substr(hash('sha256', $validatedData['destination_url'] . microtime()), 0, 4); // Using a 4-character hash

        // Create the new link
        $link = Link::create([
            'destination_url' => $validatedData['destination_url'],
            'short_url' => $shortUrl,
            'tags' => $validatedData['tags'],
            'user_id' => Auth::id(),
        ]);

        // Return a JSON response for success
        return response()->json([
            'message' => 'Link created successfully!',
            'link' => $link
        ], 201);

    } catch (\Illuminate\Database\QueryException $e) {
        // Handle database errors
        if ($e->getCode() === '23000') {
            return response()->json([
                'error' => 'The custom URL is already in use. Please choose a different one.'
            ], 400); // Return a bad request error with a specific message
        }
        return response()->json([
            'error' => 'An error occurred while creating the link. Please try again.'
        ], 500);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json([
            'error' => 'The custom URL is already in use. Please choose a different one.'
        ], 500);
    }
}




//     public function show($id)
// {
//     $link = Link::findOrFail($id); // Retrieve the link by ID

//     // Return the link details as JSON
//     return response()->json([
//         'success' => true,
//         'data' => $link,
//         'message' => 'Link retrieved successfully!',
//     ], 200);
// }




    public function edit($id)
    {
        // Retrieve the link by ID
        // dd($id);
        // Find the Link model by ID
        $link = Link::findOrFail($id);

        // Pass the retrieved Link model to the view
        return view('links.edit', compact('link'));
    }

    // public function update(Request $request, $id)
    // {
    //     // dd($id);
    //     // Validate the request inputs
    //     $request->validate([
    //         'destination_url' => 'required|url',
    //         'custom_url' => 'nullable|string|max:255',
    //         'tags' => 'nullable|string|max:255',
    //     ]);

    //     // Find the Link model by ID
    //     $link = Link::findOrFail($id);

    //     // Update the link's properties
    //     $link->destination_url = $request->destination_url;
    //     $link->short_url = $request->custom_url ?? $link->short_url; // Use provided custom URL or keep existing
    //     $link->tags = $request->tags;

    //     // Save the updated link to the database
    //     $link->save();

    //     // Redirect to the dashboard with a success message
    //     return redirect()->route('links.index')->with('success', 'Updated successfully!');
    // }



    public function update(Request $request, $id)
{
    // Validate the request inputs
    $request->validate([
        'destination_url' => 'required|url',
        'custom_url' => 'nullable|string|max:255',
        'tags' => 'nullable|string|max:255',
    ]);

    try {
        // Find the Link model by ID
        $link = Link::findOrFail($id);

        // Update the link's properties
        $link->destination_url = $request->destination_url;
        $link->short_url = $request->custom_url ?? $link->short_url; // Use provided custom URL or keep existing
        $link->tags = $request->tags;

        // Save the updated link to the database
        $link->save();

        // Redirect to the dashboard with a success message
        return redirect()->route('links.index')->with('success', 'Updated successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check if the error is due to a unique constraint violation
            if ($e->getCode() === '23000') {
                return back()->withErrors(['custom_url' => 'The custom URL is already in use. Please choose another one.'])
                            ->withInput();
            }

            // For other database errors, show a generic error message
            return back()->withErrors(['error' => 'An error occurred while updating the link. Please try again.'])
                        ->withInput();
        } catch (\Exception $e) {
            // Handle general exceptions
            return back()->withErrors(['error' => 'Something went wrong. Please try again.'])
                        ->withInput();
        }
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
