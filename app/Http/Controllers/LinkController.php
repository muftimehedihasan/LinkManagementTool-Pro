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
        $links = Link::where('user_id', Auth::id())->get();
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
        $this->authorize('update', $link);
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        $this->authorize('update', $link);

        $request->validate(['original_url' => 'required|url']);
        $link->update(['original_url' => $request->original_url]);

        return redirect()->route('links.index')->with('success', 'Link updated successfully!');
    }

    public function destroy(Link $link)
    {
        $this->authorize('delete', $link);
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link deleted successfully!');
    }

    public function redirect($short_url)
    {
        $link = Link::where('short_url', $short_url)->firstOrFail();
        $link->increment('click_count');

        return redirect($link->original_url);
    }
}
