<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('start_time', '>=', today())
            ->with('darkroom')
            ->get();

        return view('dashboard', compact('reservations'));
    }
}
