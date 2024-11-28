{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Histories</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Include Tailwind CSS -->
</head>
<body class="bg-gray-100">
    <div class="container mx-auto my-8">
        <h1 class="text-2xl font-bold mb-4">Click Histories for Link: {{ $link->short_url }}</h1>
        <table class="min-w-full bg-white border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">IP Address</th>
                    <th class="py-2 px-4 border-b">Clicked At</th>
                    <th class="py-2 px-4 border-b">User</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($link->clickHistories as $history)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b">{{ $history->ip_address ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $history->clicked_at ? $history->clicked_at->format('d M Y H:i') : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $history->user->name ?? 'Guest' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No click histories found for this link.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ url()->previous() }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">Go Back</a>
    </div>
</body>
</html> --}}

<h1>Click Histories for Link: {{ $link->short_url }}</h1>

<table class="table-auto border-collapse border border-gray-400 w-full">
    <thead>
        <tr>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Clicks</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dailyClickCounts as $dailyCount)
            <tr>
                <td class="border px-4 py-2">{{ $dailyCount->click_date }}</td>
                <td class="border px-4 py-2">{{ $dailyCount->click_count }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center py-4">No daily click counts available.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<h2 class="mt-8 text-lg font-bold">Click Histories</h2>
<table class="table-auto border-collapse border border-gray-400 w-full mt-4">
    <thead>
        <tr>
            <th class="border px-4 py-2">#</th>
            <th class="border px-4 py-2">IP Address</th>
            <th class="border px-4 py-2">Clicked At</th>
            {{-- <th class="border px-4 py-2">User</th> --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($link->clickHistories as $history)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $history->ip_address ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $history->clicked_at ? $history->clicked_at->format('d M Y H:i') : 'N/A' }}</td>
                {{-- <td class="border px-4 py-2">{{ $history->user->name ?? 'Guest' }}</td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-4">No click histories found for this link.</td>
            </tr>
        @endforelse
    </tbody>
</table>
