<?php

namespace App\Http\Controllers;

use App\Models\Darkroom;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index($id, Request $request)
    {
        $darkroom = Darkroom::findOrFail($id);

        $reservations = $darkroom->reservations()->get();

        $events = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'title' => $reservation->name,
                'start' => $reservation->start_time,
                'end' => $reservation->end_time,
            ];
        });

        return response()->json($events);
    }

    public function store($id, Request $request)
    {
        $darkroom = Darkroom::findOrFail($id);

        $request->validate([
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'user_id' => 'required|exists:users,id',
        ]);

        $reservation = $darkroom->reservations()->create([
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'user_id' => $request->get('user_id'),
        ]);

        return response()->json(['success' => true, 'reservation' => $reservation]);
    }
}
