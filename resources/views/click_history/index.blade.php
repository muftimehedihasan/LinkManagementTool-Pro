<!-- resources/views/link_history/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Click History for Link: {{ $link->short_url }}</h1>

    <table>
        <thead>
            <tr>
                <th>IP Address</th>
                <th>User ID</th>
                <th>Clicked At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clickHistories as $history)
                <tr>
                    <td>{{ $history->ip_address }}</td>
                    <td>{{ $history->user_id ?? 'Guest' }}</td>
                    <td>{{ $history->clicked_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
