<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Example static values, replace with database logic
        $clicksThisWeek = Click::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        $clicksLastWeek = Click::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek()
        ])->count();

        // Calculate growth percentage
        $clickGrowthPercentage = $clicksLastWeek > 0
            ? round((($clicksThisWeek - $clicksLastWeek) / $clicksLastWeek) * 100, 2)
            : 0;

        return view('dashboard', [
            'clicksThisWeek' => $clicksThisWeek,
            'clickGrowthPercentage' => $clickGrowthPercentage,
        ]);
    }
}
