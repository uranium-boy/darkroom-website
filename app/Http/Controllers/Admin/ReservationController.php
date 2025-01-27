<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Darkroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ReservationController extends Controller {
    public function index()
    {
        $darkrooms = Darkroom::select('id', 'name')->get();
        $firstDarkroomId = $darkrooms->first()->id; // Get the ID of the first darkroom

        $reservations = Reservation::where('darkroom_id', $firstDarkroomId)
            ->where('start_time', '>=', today())
            ->with('user')
            ->get();

        return view('admin.reservations.index', compact('darkrooms', 'reservations', 'firstDarkroomId'));
    }

    public function destroy($reservationId) {

        $reservation = Reservation::findOrFail($reservationId);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
