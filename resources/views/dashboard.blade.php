<x-app-layout>
    @include('layouts.sidebar')

    <div class="flex items-center justify-center bg-white h-screen ml-28 mt-16">
        <div class="max-w-3xl w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between">
                {{-- <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">32.4k</h5>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Clicks this week</p>
                </div> --}}

                <div>
                    <h5 id="total-clicks" class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Analytics</h5>
                    {{-- <p class="text-base font-normal text-gray-500 dark:text-gray-400">Clicks this week</p> --}}
                </div>
                

                <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                    12%
                    <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                    </svg>
                </div>
            </div>

            <!-- Chart Container -->
            <div id="area-chart" class="mt-5"></div>

            <!-- Dropdown and Action Buttons -->
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <!-- Dropdown -->
                    <button
                        id="dropdownDefaultButton"
                        data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 7 days
                        <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" data-range="yesterday" class="range-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                            </li>
                            <li>
                                <a href="#" data-range="today" class="range-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                            </li>
                            <li>
                                <a href="#" data-range="last7days" class="range-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#" data-range="last30days" class="range-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                            </li>
                            <li>
                                <a href="#" data-range="last90days" class="range-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Download Button -->
                    <a href="#" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                        Download
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const chartContainer = document.getElementById("area-chart");
        const rangeOptions = document.querySelectorAll(".range-option");
        let chart; // Store the chart instance

        // Base chart options
        const options = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: { show: false }
            },
            series: [],
            xaxis: { categories: [] },
            yaxis: { labels: { formatter: val => val.toFixed(0) } },
        };

        // Function to fetch chart data dynamically
        const fetchChartData = async (range) => {
            try {
                const response = await fetch(`/chart-data?range=${range}`);
                const data = await response.json();

                // Update chart with new data
                const updatedOptions = {
                    series: [{ name: 'Clicks', data: data.clicks }],
                    xaxis: { categories: data.dates },
                };

                if (chart) {
                    chart.updateOptions(updatedOptions);
                } else {
                    chart = new ApexCharts(chartContainer, { ...options, ...updatedOptions });
                    chart.render();
                }
            } catch (error) {
                console.error('Error fetching chart data:', error);
            }
        };

        // Add event listeners to range options
        rangeOptions.forEach(option => {
            option.addEventListener('click', event => {
                event.preventDefault();
                const range = option.dataset.range;
                fetchChartData(range);
            });
        });

        // Fetch initial data for default range
        fetchChartData('last7days');
    });
</script>














{{-- <script>
    $(document).ready(function () {
        const rangeOptions = $(".range-option");
        const chartContainer = $("#area-chart");

        // Fetch chart data based on the selected range
        const fetchChartData = (range) => {
            $.ajax({
                url: `/chart-data?range=${range}`,
                method: 'GET',
                success: function (response) {
                    // Update Total Clicks and Percentage Change
                    const totalClicks = response.clicks.reduce((acc, val) => acc + val, 0);
                    $('#total-clicks').text(totalClicks.toLocaleString());

                    const percentageChange = Math.round(((response.clicks[response.clicks.length - 1] - response.clicks[0]) / response.clicks[0]) * 100);
                    $('#percentage-change').text(percentageChange + '%');

                    // Render the chart with new data
                    const options = {
                        chart: {
                            height: "100%",
                            type: "area",
                            fontFamily: "Inter, sans-serif",
                            toolbar: { show: false },
                        },
                        tooltip: { enabled: true },
                        fill: {
                            type: "gradient",
                            gradient: { opacityFrom: 0.55, opacityTo: 0 },
                        },
                        dataLabels: { enabled: false },
                        stroke: { width: 6 },
                        grid: { show: false },
                        series: [
                            {
                                name: "Clicks",
                                data: response.clicks,
                                color: "#1A56DB",
                            },
                        ],
                        xaxis: {
                            categories: response.dates,
                            labels: { show: true },
                        },
                        yaxis: { show: true },
                    };

                    const chart = new ApexCharts(chartContainer[0], options);
                    chart.render();
                },
                error: function () {
                    alert("Failed to load chart data.");
                }
            });
        };

        // Initial data load for "Last 7 days"
        fetchChartData("last7days");

        // Event listener for range options
        rangeOptions.each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                const range = $(this).data("range");
                fetchChartData(range);
            });
        });
    });
</script> --}}
