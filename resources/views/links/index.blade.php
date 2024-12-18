<x-app-layout>


    @include('layouts.sidebar')

    <div class="p-2 sm:ml-40">
        <div class=" ">


    <section class="bg-orange-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 py-16 lg:px-12">

                    {{-- /////////////////// --}}

 {{-- Success Message --}}
 @if (session('success'))
 <div class="mb-4 flex items-center rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
     role="alert">
     <svg class="me-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true"
         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
         <path
             d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
     </svg>
     <span class="sr-only">Success</span>
     <div>
         <span class="font-medium">Success!</span> {{ session('success') }}
     </div>
 </div>
@endif


            {{-- ///////////////////// --}}
        <!-- Start coding here -->
<div class="bg-orange-50 dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-0">

                <div class="w-full md:w-full">
                    <form action="{{ route('links.search') }}" method="GET" class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="query" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search (URL, Tags, Time)" value="{{ request('query') }}" required>
                             <button type="submit" class="text-white absolute end-0 bottom-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>


                </div>

                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

<!-- Modal toggle -->
<!-- Modal Trigger -->
<button data-modal-target="default-modal" data-modal-toggle="default-modal"
    class="block text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Create Link
</button>

<!-- Modal -->
@include('create-modal')


                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                            Actions
                        </button>
                        <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">

                            <div class="py-1">
                                {{-- <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export as CSV</a> --}}
                                <a href="{{ route('export.csv') }}"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                target="_blank"
                                rel="noopener noreferrer">
                                Export as CSV
                                </a>
                            </div>

                        </div>
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            {{-- <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose tag</h6> --}}
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">


                                <li class="flex items-center">
                                    <input id="tag" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="tag" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tags</label>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="overflow-x-auto mt-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">Short Url</th>
                <th scope="col" class="px-4 py-3">Destination URL</th>
                <th scope="col" class="px-4 py-3">Tags</th>
                <th scope="col" class="px-4 py-3">Date</th>
                <th scope="col" class="px-4 py-3">Click</th>
                <th scope="col" class="px-4 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @if($links->isEmpty())
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                        <img src="{{ asset('images/no-data-found.png') }}" alt="No Data Found" class="inline-block mt-2 w-90 h-auto">
                    </td>
                </tr>
            @else
                @foreach($links as $link)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('redirect', ['custom_url' => $link->short_url]) }}"
                           class="text-slate-500 no-underline hover:underline"
                           target="_blank"
                           rel="noopener noreferrer">
                            {{ url('s/' . $link->short_url) }}
                        </a>
                    </th>
                    <td class="px-4 py-3">{{ $link->destination_url }}</td>
                    <td class="px-4 py-3">{{ $link->tags }}</td>
                    <td class="px-4 py-3">{{ $link->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3">{{ $link->click_count }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <button id="{{ $link->short_url }}-button" data-dropdown-toggle="{{ $link->short_url }}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                        <div id="{{ $link->short_url }}-dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="{{ $link->short_url }}-button">
                                <li>
                                    <a href="{{ route('links.edit', $link->id) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Edit
                                    </a>
                                </li>
                            </ul>

                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="{{ $link->short_url }}-button">
                                <li>
                                    <a href="{{ route('clickHistories.index', $link->id) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Analytics
                                    </a>
                                </li>
                            </ul>


                            <div class="py-1">
                                <a href="#" onclick="deleteLink({{ $link->id }})" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

                    <!-- Pagination Links -->
            <div class="p-4">
                {{ $links->links('pagination::tailwind') }}
            </div>

        </div>
    </div>
    </section>

        </div>
    </div>

</x-app-layout>



<script>
    // For Actions dropdown
    document.getElementById('actionsDropdownButton').addEventListener('click', function() {
        const actionsDropdown = document.getElementById('actionsDropdown');
        actionsDropdown.classList.toggle('hidden');  // Toggle visibility
    });

    // For Filter dropdown
    document.getElementById('filterDropdownButton').addEventListener('click', function() {
        const filterDropdown = document.getElementById('filterDropdown');
        filterDropdown.classList.toggle('hidden');  // Toggle visibility
    });

    // Optional: Close dropdowns if clicked outside of the dropdown
    document.addEventListener('click', function(event) {
        const actionsDropdown = document.getElementById('actionsDropdown');
        const filterDropdown = document.getElementById('filterDropdown');

        // Close if clicked outside of actions dropdown
        if (!event.target.closest('#actionsDropdownButton') && !event.target.closest('#actionsDropdown')) {
            actionsDropdown.classList.add('hidden');
        }

        // Close if clicked outside of filter dropdown
        if (!event.target.closest('#filterDropdownButton') && !event.target.closest('#filterDropdown')) {
            filterDropdown.classList.add('hidden');
        }
    });



    document.addEventListener('DOMContentLoaded', function () {
    // Dropdown toggle functionality
    document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', function () {
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        });
    });

    // Close dropdown when clicking outside of it
    document.addEventListener('click', function (event) {
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            const dropdown = document.getElementById(dropdownId);

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
});


// Function to handle the create action



// Function to handle the delete action
function deleteLink(linkId) {
    if (confirm('Are you sure you want to delete this link?')) {
        // Make an AJAX request to delete the link
        fetch(`/links/${linkId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Link deleted successfully');
                window.location.reload(); // Reload the page to reflect the changes
            } else {
                alert('Failed to delete the link');
            }
        })
        .catch(error => {
            alert('Error deleting the link');
        });
    }
}

// Function to handle the edit action
function editLink(linkId) {
    // Redirect to the edit page for this link (assuming you have an edit route)
    window.location.href = `/links/${linkId}/edit`;
}

// Create form

// document.getElementById('linkForm').addEventListener('submit', function (e) {
//     e.preventDefault();

//     const formData = new FormData(this);
//     const errorContainer = document.getElementById('errorContainer');
//     const successContainer = document.getElementById('successContainer');

//     // Clear previous messages
//     errorContainer.classList.add('hidden');
//     successContainer.classList.add('hidden');
//     errorContainer.innerHTML = '';
//     successContainer.innerHTML = '';

//     fetch("{{ route('links.store') }}", {
//         method: "POST",
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
//             'Accept': 'application/json',
//         },
//         body: formData,
//     })
//         .then(response => {
//             if (!response.ok) {
//                 return response.json().then(err => {
//                     throw err;
//                 });
//             }
//             return response.json();
//         })
//         .then(data => {
//             // Redirect to the links index with a success message
//             const redirectUrl = "{{ route('links.index') }}?success=Link created successfully!";
//             window.location.href = redirectUrl;
//         })
//         .catch(error => {
//             // Display error messages
//             errorContainer.classList.remove('hidden');
//             if (error.errors) {
//                 Object.values(error.errors).forEach(err => {
//                     errorContainer.innerHTML += `<p>${err}</p>`;
//                 });
//             } else {
//                 errorContainer.innerHTML = `<p>${error.error || 'The custom URL is already in use. Please choose a different one.'}</p>`;
//             }
//         });
// });

document.getElementById('linkForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const errorContainer = document.getElementById('errorContainer');
    const successContainer = document.getElementById('successContainer');

    // Clear previous messages
    errorContainer.classList.add('hidden');
    successContainer.classList.add('hidden');
    errorContainer.innerHTML = '';
    successContainer.innerHTML = '';

    fetch("{{ route('links.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            'Accept': 'application/json',
        },
        body: formData,
    })
        .then(response => response.json())  // Always parse JSON response
        .then(data => {
            if (data.error) {
                // If there is an error in the response
                errorContainer.classList.remove('hidden');
                errorContainer.innerHTML = `<p>${data.error}</p>`;
            } else if (data.message) {
                // If the success message exists in the response
                successContainer.classList.remove('hidden');
                successContainer.innerHTML = `<p>${data.message}</p>`;
                // Optionally reset the form or redirect
                document.getElementById('linkForm').reset();

                // Optionally redirect after a short delay
                setTimeout(() => {
                    window.location.href = "{{ route('links.index') }}";
                }, 2000);
            }
        })
        .catch(error => {
            // If something goes wrong in fetching or parsing the response
            errorContainer.classList.remove('hidden');
            errorContainer.innerHTML = `<p>The custom URL is already in use. Please choose a different one.</p>`;
        });
});





</script>








