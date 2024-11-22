<?php

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Fetch links that belong to the authenticated user
    $links = Link::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);

    return view('dashboard', compact('links'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('links', LinkController::class);
});

Route::get('/search', [LinkController::class, 'search'])->name('links.search');


Route::delete('/links/delete-all', [LinkController::class, 'deleteAll'])->name('links.deleteAll')->middleware(['auth', 'verified']);


Route::prefix('short')->group(function () {
    Route::get('/{custom_url}', [RedirectController::class, 'redirect'])->name('redirect');
});

Route::get('/export-csv', [ExportController::class, 'exportAsCSV'])->name('export.csv');


require __DIR__.'/auth.php';
