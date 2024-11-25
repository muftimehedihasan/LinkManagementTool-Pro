<div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <!-- Modal Body -->
            <div class="p-4 md:p-5 space-y-4">
                <form id="linkForm" class="space-y-6">
                    @csrf

                    <!-- Error Container -->
                    <div id="errorContainer" class="hidden p-4 text-sm text-red-800 bg-red-50 border border-red-200 rounded-lg"></div>

                    <!-- Success Message -->
                    <div id="successContainer" class="hidden p-4 text-sm text-green-800 bg-green-50 border border-green-200 rounded-lg"></div>

                    <!-- Destination URL Field -->
                    <div class="mb-6">
                        <label for="destination_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination
                            URL<span class="text-red-600">*</span></label>
                        <input type="url" name="destination_url" id="destination_url"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="https://example.com" required>
                    </div>

                    <!-- Custom URL Field -->
                    <div class="mb-6">
                        <label for="custom_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Custom URL
                            (Optional)</label>
                        <input type="text" name="custom_url" id="custom_url"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter a custom short URL">
                    </div>

                    <!-- Tags Field -->
                    <div class="mb-6">
                        <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags (Optional)</label>
                        <input type="text" name="tags" id="tags"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="e.g., technology, tools">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
