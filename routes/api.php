<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\RedirectController;
use App\Http\Controllers\Api\ClickHistoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('links', LinkController::class);
});


Route::prefix('s')->middleware('auth:sanctum')->group(function () {
    Route::get('/{custom_url}', [RedirectController::class, 'redirect'])->name('redirect');
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chart-data', [ChartController::class, 'getChartData'])->name('chart.data');
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/clicks/{linkId}', [ClickHistoryController::class, 'recordClick'])->name('api.recordClick');
    Route::get('/clicks/{linkId}', [ClickHistoryController::class, 'getClickHistory'])->name('api.getClickHistory');
    Route::get('/chart-data/{linkId}', [ClickHistoryController::class, 'getChartData'])->name('api.getChartData');
});
