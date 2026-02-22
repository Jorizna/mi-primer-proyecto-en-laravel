<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

// Home
Route::get('/', [MovieController::class, 'home'])->name('home');

// Dashboard (redirige al home)
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mis películas
    Route::get('/my-movies', [MovieController::class, 'mine'])->name('movies.mine');

    // Películas — acciones protegidas (create, store, edit, update, destroy)
    Route::resource('movies', MovieController::class)->except(['index', 'show']);

    // Valoraciones
    Route::post('/movies/{movie}/rating', [RatingController::class, 'store'])->name('movies.rating');

    // Reseñas
    Route::post('movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Películas públicas — DESPUÉS del grupo auth
Route::resource('movies', MovieController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
