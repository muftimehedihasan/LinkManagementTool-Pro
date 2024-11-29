<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\RedirectController;

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
