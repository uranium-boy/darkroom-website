<?php

namespace App\Http\Controllers;

use App\Models\Darkroom;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index($darkroomId)
    {
        $userId = auth()->id();

        $reservations = Reservation::where('darkroom_id', $darkroomId)
            ->get()
            ->map(function ($reservation) use ($userId) {
                return [
                    'start' => $reservation->start_time,
                    'end' => $reservation->end_time,
                    'is_user_reservation' => $reservation->user_id === $userId,
                ];
            });

        return response()->json($reservations);
    }

    public function store(Request $request, $darkroomId)
    {
        $darkroom = Darkroom::findOrFail($darkroomId);

        $validated = $request->validate([
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'user_id' => 'required|exists:users,id',
        ]);

        $overlaps = Reservation::where('darkroom_id', $darkroomId)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('start_time', '<', $validated['start_time'])
                            ->where('end_time', '>', $validated['end_time']);
                    });
            })
            ->exists();

        if ($overlaps) {
            return response()->json(['error' => 'Time slot is already reserved.'], 422);
        }

        $reservation = $darkroom->reservations()->create([
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'user_id' => $request->get('user_id'),
        ]);

        return response()->json(['success' => true]);
    }
}
