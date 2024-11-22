<x-app-layout>


    
    <div class="flex items-center justify-center min-h-screen orange-100">
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <!-- Modal body -->
            <div class="p-4 md:p-8 space-y-4">
                <form action="{{ route('links.update', $link->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-6">
                        <label for="destination_url_{{ $link->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination URL</label>
                        <input type="url" name="destination_url" id="destination_url_{{ $link->id }}" value="{{ $link->destination_url }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label for="custom_url_{{ $link->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Short Url</label>
                        <input type="text" name="custom_url" id="custom_url_{{ $link->id }}" value="{{ $link->short_url }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="short-url">
                    </div>
                    <div class="mb-6">
                        <label for="tags_{{ $link->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                        <input type="text" name="tags" id="tags_{{ $link->id }}" value="{{ $link->tags }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g., technology, tools">
                    </div>
        
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
    



</x-app-layout>





















{{-- <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">

            <form action="{{ route('links.update', $link->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-6">
                <label for="destination_url_{{ $link->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination URL</label>
                <input type="url" name="destination_url" id="destination_url_{{ $link->id }}" value="{{ $link->destination_url }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="custom_url_{{ $link->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Short Url</label>
                <input type="text" name="custom_url" id="custom_url_{{ $link->id }}" value="{{ $link->short_url }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="short-url">
            </div>
            <div class="mb-6">
                <label for="tags_{{ $link->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                <input type="text" name="tags" id="tags_{{ $link->id }}" value="{{ $link->tags }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g., technology, tools">
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>


                </div>
            </div>
        </div>
    </div> --}}





        {{-- <form action="{{ route('links.update', $link->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="destination_url" class="form-label">Destination URL</label>
                <input
                    type="url"
                    id="destination_url"
                    name="destination_url"
                    class="form-control"
                    value="{{ old('destination_url', $link->destination_url) }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="custom_url" class="form-label">Custom URL</label>
                <input
                    type="text"
                    id="custom_url"
                    name="custom_url"
                    class="form-control"
                    value="{{ old('custom_url', $link->short_url) }}"
                >
                <small class="form-text text-muted">Optional: Provide a custom short URL.</small>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input
                    type="text"
                    id="tags"
                    name="tags"
                    class="form-control"
                    value="{{ old('tags', $link->tags) }}"
                >
                <small class="form-text text-muted">Optional: Add tags separated by commas.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Link</button>
       <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
 --}}
