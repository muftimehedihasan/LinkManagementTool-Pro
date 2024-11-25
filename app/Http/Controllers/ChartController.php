<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function getChartData(Request $request)
    {
        $range = $request->query('range', 'last7days'); // Default to 'last7days'

        try {
            // Ensure the user is authenticated
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Define date ranges
            switch ($range) {
                case 'yesterday':
                    $startDate = now()->subDay()->startOfDay();
                    $endDate = now()->subDay()->endOfDay();
                    break;
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'last30days':
                    $startDate = now()->subDays(30);
                    $endDate = now();
                    break;
                case 'last90days':
                    $startDate = now()->subDays(90);
                    $endDate = now();
                    break;
                case 'last7days':
                default:
                    $startDate = now()->subDays(7);
                    $endDate = now();
                    break;
            }

            // Query data within the selected date range for the authenticated user
            $data = DB::table('links')
                ->selectRaw('DATE(updated_at) as date, SUM(click_count) as total_clicks')
                ->where('user_id', $user->id) // Filter by authenticated user
                ->whereBetween('updated_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            return response()->json([
                'dates' => $data->pluck('date')->map(fn($date) => date('d F', strtotime($date))),
                'clicks' => $data->pluck('total_clicks'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
