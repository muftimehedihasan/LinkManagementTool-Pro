<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{

    /**
     * Retrieve chart data for authenticated user.
     */
    public function getChartData(Request $request)
    {
        $range = $request->query('range', 'last7days'); // Default range: 'last7days'

        try {
            // Ensure the user is authenticated
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Define date ranges based on the selected range
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
                ->where('user_id', $user->id) // Filter by the authenticated user
                ->whereBetween('updated_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Transform data for frontend charting
            return response()->json([
                'success' => true,
                'data' => [
                    'dates' => $data->pluck('date')->map(fn($date) => date('d F', strtotime($date))),
                    'clicks' => $data->pluck('total_clicks'),
                ],
            ]);
        } catch (\Exception $e) {
            // Return error response for unexpected exceptions
            return response()->json(['error' => 'An error occurred while retrieving chart data.'], 500);
        }
    }
}
