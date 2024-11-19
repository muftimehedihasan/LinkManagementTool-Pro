{{-- Display a list of all links for the authenticated user --}}

{{-- @extends('layouts.app') --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <h1>Link Management Tool</h1>

                    @if(session('success'))
                        <p>{{ session('success') }}</p>
                    @endif

                    <a href="{{ route('links.create') }}">Create a New Link</a>

                    <ul>
                        @foreach($links as $link)
                            <li>
                                <p>Original URL: {{ $link->original_url }}</p>
                                <p>Short URL: <a href="{{ url($link->short_url) }}">{{ url($link->short_url) }}</a></p>
                                {{-- <p>Clicks: {{ $link->click_count }}</p> --}}
                                <a href="{{ route('links.edit', $link) }}">Edit</a>
                                <form action="{{ route('links.destroy', $link) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>







        </div>
    </div>
</x-app-layout>




    <table>
        <thead>
            <tr>
                <th>Original URL</th>
                <th>Shortened URL</th>
                <th>Custom Domain</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->original_url }}</td>
                    <td>{{ url($link->shortened_url) }}</td>
                    <td>{{ $link->custom_domain ?? 'None' }}</td>
                    <td>
                        <a href="{{ route('links.edit', $link) }}">Edit</a>
                        <form action="{{ route('links.destroy', $link) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
{{-- @endsection --}}
