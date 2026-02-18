<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
// Home
Route::get('/', [MovieController::class, 'home'])->name('home');

// Dashboard Breeze (ya lo redirigimos al welcome)
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CRUD Películas
Route::resource('movies', MovieController::class);

// Valoraciones
Route::post('/movies/{movie}/rating', [RatingController::class, 'store'])
    ->name('movies.rating')
    ->middleware('auth');

Route::post('movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

require __DIR__.'/auth.php';
