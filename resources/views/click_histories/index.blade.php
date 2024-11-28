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





 <h1 class="mt-30">Click Histories for Link: {{ $link->short_url }}</h1>


<!-- ====== Table Section Start -->
{{-- <section class="bg-white dark:bg-dark py-20 lg:py-[120px]">
    <div class="container mx-auto">
       <div class="flex flex-wrap -mx-4">
          <div class="w-full px-4">
             <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                   <thead>
                      <tr class="text-center bg-primary">
                         <th
                            class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4"
                            >
                            Date
                         </th>
                         <th
                            class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4"
                            >
                            Clicks
                         </th>

                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         @forelse ($dailyClickCounts as $dailyCount)
                         <td
                            class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"
                            >
                            {{ $dailyCount->click_date }}
                         </td>
                         <td
                            class="text-dark border-b border-[#E8E8E8] bg-white dark:border-dark dark:bg-dark-2 dark:text-dark-7 py-5 px-2 text-center text-base font-medium"
                            >
                            {{ $dailyCount->click_count }}
                         </td>

                         @empty
                         <tr>
                             <td colspan="2" class="text-center py-4">No daily click counts available.</td>
                         </tr>
                     @endforelse
                      </tr>


                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- ====== Table Section End --> --}}




<table class="table-auto border-collapse border border-gray-400 w-full">
    <thead>
         <h2 class="mt-8 text-lg font-bold">Daily click counts</h2>
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

        </tr>
    </thead>
    <tbody>
        @forelse ($link->clickHistories as $history)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $history->ip_address ?? 'N/A' }}</td>


                <td class="border px-4 py-2">
                    @if ($history->clicked_at)
                        {{ \Carbon\Carbon::parse($history->clicked_at)->format('d M Y H:i') }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-4">No click histories found for this link.</td>
            </tr>
        @endforelse
    </tbody>
</table>












<script src="https://cdn.jsdelivr.net/npm/tailgrids@2.2.2/plugin.min.js"></script>
<link
  href="https://cdn.jsdelivr.net/npm/tailgrids@2.2.2/assets/css/tailwind.min.css"
  rel="stylesheet"
/>


















{{-- <x-app-layout>
    <input type="hidden" id="link-id" value="{{ $link->id }}" />

    <div id="area-chart" class="mt-5"></div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // JavaScript for the chart (as shown above)
    </script>
</x-app-layout>




<script>

document.addEventListener("DOMContentLoaded", () => {
    const chartContainer = document.getElementById("area-chart");
    const rangeOptions = document.querySelectorAll(".range-option");
    const linkId = 123; // Replace with the actual link_id

    let chart;

    const options = {
        chart: { height: 350, type: "area", toolbar: { show: false } },
        series: [],
        xaxis: { categories: [] },
        yaxis: { labels: { formatter: val => val.toFixed(0) } },
    };

    const fetchChartData = async (range) => {
        try {
            const response = await fetch(`/chart-data/${linkId}?range=${range}`);
            const data = await response.json();

            const updatedOptions = {
                series: [{ name: "Clicks", data: data.clicks }],
                xaxis: { categories: data.dates },
            };

            if (chart) {
                chart.updateOptions(updatedOptions);
            } else {
                chart = new ApexCharts(chartContainer, { ...options, ...updatedOptions });
                chart.render();
            }
        } catch (error) {
            console.error("Error fetching chart data:", error);
        }
    };

    // Event listeners for range options
    rangeOptions.forEach(option => {
        option.addEventListener("click", event => {
            event.preventDefault();
            const range = option.dataset.range;
            fetchChartData(range);
        });
    });

    // Load today's data by default
    fetchChartData("today");
});

</script> --}}
