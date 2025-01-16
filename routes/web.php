<?php

use App\Http\Controllers\DarkroomController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

// Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
// Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('/darkrooms/{id}/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');
Route::post('/darkrooms/{id}/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');
Route::get('/darkrooms/{id}/opening-time', [DarkroomController::class, 'getOpeningTime'])
    ->name('darkrooms.opening-hours');

require __DIR__.'/auth.php';
