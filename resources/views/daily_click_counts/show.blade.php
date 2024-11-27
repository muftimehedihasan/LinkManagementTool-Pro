<!-- resources/views/daily_click_counts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Details for Click Count on {{ $dailyClickCount->click_date }}</h1>
    <p>Click Count: {{ $dailyClickCount->click_count }}</p>
    <p>Link: <a href="{{ route('links.show', $dailyClickCount->link->id) }}">{{ $dailyClickCount->link->short_url }}</a></p>
@endsection
