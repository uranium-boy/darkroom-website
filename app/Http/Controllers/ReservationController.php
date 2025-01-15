<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'darkroom_id' => 'required|exists:darkrooms,id',
        ]);

        $reservation = Reservation::with('darkroom')
            ->where('darkroom_id', $request->get('darkroom_id'))
        ->get();

        $events = $reservation->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'title' => $reservation->darkroom->name,
                'start' => $reservation->start_time,
                'end' => $reservation->end_time,
            ];
        });

        return response()->json($events);
    }
}
