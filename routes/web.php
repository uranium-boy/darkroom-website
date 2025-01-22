<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DarkroomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

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

Route::middleware('auth')->group(function () {
    Route::get('/reservations', function () {
        return view('reservations');
    })->name('reservations');
});

// Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
// Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('/darkrooms/{id}/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');
Route::post('/darkrooms/{id}/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');
Route::get('/darkrooms/{id}/operating-time', [DarkroomController::class, 'getOperatingTime'])
    ->name('darkrooms.operating-time');

require __DIR__.'/auth.php';
