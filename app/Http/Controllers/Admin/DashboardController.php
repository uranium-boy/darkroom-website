<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller {
    public function index() {
        $userCount = User::count();
        $reservationCount = Reservation::count();
        return view('admin.dashboard', compact('userCount', 'reservationCount'));
    }
}
