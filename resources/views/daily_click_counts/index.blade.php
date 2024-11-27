<!-- resources/views/daily_click_counts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daily Click Counts for Link: {{ $link->short_url }}</h1>

    <ul>
        @foreach ($dailyClickCounts as $dailyClickCount)
            <li>
                <a href="{{ route('daily-click-counts.show', $dailyClickCount->id) }}">
                    {{ $dailyClickCount->click_date }} - {{ $dailyClickCount->click_count }} clicks
                </a>
            </li>
        @endforeach
    </ul>
@endsection
