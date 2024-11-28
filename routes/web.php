<?php

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClickHistoryController;
use App\Http\Controllers\DailyClickCountController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     // Fetch links that belong to the authenticated user
//     $links = Link::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
//     return view('dashboard', compact('links'));
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/chart-data', [ChartController::class, 'getChartData']);

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


Route::prefix('s')->group(function () {
    Route::get('/{custom_url}', [RedirectController::class, 'redirect'])->name('redirect');
});

Route::get('/export-csv', [ExportController::class, 'exportAsCSV'])->name('export.csv');



// Route to track clicks
Route::get('track-click/{shortUrl}', [ClickHistoryController::class, 'trackClick'])->name('track.click');

// Route to show click history
Route::get('click-history/{shortUrl}', [ClickHistoryController::class, 'showClickHistory'])->name('click.history');




Route::get('/links/{link}/click-histories', [ClickHistoryController::class, 'index'])->name('clickHistories.index');

// routes/web.php

Route::get('/links/{linkId}/daily-click-counts', [DailyClickCountController::class, 'index'])->name('daily-click-counts.index');
Route::get('/daily-click-counts/{id}', [DailyClickCountController::class, 'show'])->name('daily-click-counts.show');



require __DIR__.'/auth.php';
