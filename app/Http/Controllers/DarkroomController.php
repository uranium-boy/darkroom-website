<?php

namespace App\Http\Controllers;

use App\Models\Darkroom;

class DarkroomController extends Controller
{
    /*    public function index()
        {
            $darkrooms = Darkroom::all();

            return response()->json($darkrooms);
        }*/

    public function getOperatingTime($darkroomId)
    {
        $darkroom = Darkroom::findOrFail($darkroomId);

        return response()->json([
            'opening_time' => $darkroom->opening_time,
            'closing_time' => $darkroom->closing_time,
        ]);
    }

    public function getNames()
    {
        $darkrooms = Darkroom::select('id', 'name')->get();

        return response()->json($darkrooms);
    }

    public function getStatus($darkroomId)
    {
        $darkroom = Darkroom::findOrFail($darkroomId);

        return response()->json(['is_active' => $darkroom->is_active]);
    }
}
