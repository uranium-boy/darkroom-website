<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Darkroom;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $darkrooms = $this->getDarkrooms();

        $selectedDarkroomId = $request->get('darkroom_id') ?? $darkrooms->first()->id;

        if ($request->get('past') === 'true') {
            $reservations = Reservation::where('darkroom_id', $selectedDarkroomId)
                ->where('start_time', '<', today())
                ->with('user')
                ->get();
        } else {
            $reservations = Reservation::where('darkroom_id', $selectedDarkroomId)
                ->where('start_time', '>=', today())
                ->with('user')
                ->get();
        }

        return view('admin.reservations.index', compact('darkrooms', 'reservations', 'selectedDarkroomId'));
    }

    public function getDarkrooms()
    {
        return Darkroom::select('name', 'id')->get();
    }

    public function destroy($reservationId)
    {

        $reservation = Reservation::findOrFail($reservationId);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
