<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function exportAsCSV()
    {
        // Fetch data to export
        $data = Link::all(); 

        // Define CSV file headers
        $csvHeaders = ['short_url', 'destination_url', 'tags'];

        // Initialize CSV content
        $csvContent = implode(',', $csvHeaders) . "\n";

        // Add rows to CSV
        foreach ($data as $row) {
            $csvContent .= $row->short_url . ',' . $row->destination_url . ',' . $row->tags . "\n";
        }

        // Return CSV as download response
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ]);
    }
}
