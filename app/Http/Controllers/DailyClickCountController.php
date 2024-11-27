<?php
// app/Http/Controllers/DailyClickCountController.php

namespace App\Http\Controllers;

use App\Models\DailyClickCount;
use App\Models\Link;
use Illuminate\Http\Request;

class DailyClickCountController extends Controller
{
    /**
     * Display the daily click counts for a specific link.
     *
     * @param  int  $linkId
     * @return \Illuminate\Http\Response
     */
    public function index($linkId)
    {
        // Find the link by ID
        $link = Link::findOrFail($linkId);

        // Get the daily click counts for the given link
        $dailyClickCounts = $link->dailyClickCounts; // Using the defined relationship

        // Return a view or JSON response (depending on your needs)
        return view('daily_click_counts.index', compact('dailyClickCounts', 'link'));
    }

    /**
     * Display the details of a single daily click count.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the DailyClickCount by its ID
        $dailyClickCount = DailyClickCount::findOrFail($id);

        // Return a view or JSON response (depending on your needs)
        return view('daily_click_counts.show', compact('dailyClickCount'));
    }
}
