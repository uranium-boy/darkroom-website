<?php

use App\Http\Controllers\Admin\DarkroomController as AdminDarkroomController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DarkroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

/*Route::get('/welcome', function () {
    return view('home');
})->name('welcome');*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    /* Managing Darkrooms */
    Route::get('admin/darkrooms', [AdminDarkroomController::class, 'index'])->name('admin.darkrooms.index');
    Route::post('admin/darkrooms', [AdminDarkroomController::class, 'store'])->name('admin.darkrooms.store');
    Route::get('admin/darkrooms/create', [AdminDarkroomController::class, 'create'])->name('admin.darkrooms.create');
    Route::get('admin/darkrooms/{darkroom}/edit', [AdminDarkroomController::class, 'edit'])->name('admin.darkrooms.edit');
    Route::put('admin/darkrooms/{darkroom}', [AdminDarkroomController::class, 'update'])->name('admin.darkrooms.update');
    Route::delete('admin/darkrooms/{darkroom}', [AdminDarkroomController::class, 'destroy'])->name('admin.darkrooms.destroy');

    /* Managing Users */
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::get('admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    /* Managing Reservations */
    Route::get('admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');
    Route::delete('admin/reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('admin.reservations.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/reservations', function () {
        return view('reservations');
    })->name('reservations');
    Route::delete('/reservations/{reservationId}', [ReservationController::class, 'destroy'])
        ->name('reservations.destroy');
});

/* Darkrooms info */
Route::get('/darkrooms/names', [DarkroomController::class, 'getNames'])
    ->name('darkrooms.names');
Route::get('/darkrooms/{id}/operating-time', [DarkroomController::class, 'getOperatingTime'])
    ->name('darkrooms.operating-time');
Route::get('/darkrooms/{id}/status', [DarkroomController::class, 'getStatus'])
    ->name('darkrooms.status');

/* Reservations */
Route::get('/darkrooms/{id}/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');
Route::post('/darkrooms/{id}/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');

require __DIR__.'/auth.php';
