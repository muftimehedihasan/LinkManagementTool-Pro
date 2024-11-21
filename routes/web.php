<?php

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $links = Link::orderBy('created_at', 'desc')->paginate(5);
    return view('dashboard', compact('links'));

    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('links', LinkController::class);
});

Route::get('/{short_url}', [LinkController::class, 'redirect'])->name('links.redirect');

// Route::get('/original/{short_url}', [LinkController::class, 'redirect'])->name('links.redirect');
// Route::prefix('original')->group(function () {
//     Route::get('/{short_url}', [LinkController::class, 'redirect'])->name('links.redirect');
// });






require __DIR__.'/auth.php';
