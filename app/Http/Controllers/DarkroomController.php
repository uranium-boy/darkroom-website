<?php

namespace App\Http\Controllers;

use App\Models\Darkroom;

class DarkroomController extends Controller
{
    public function getOperatingTime($darkroomId)
    {
        $darkroom = Darkroom::findOrFail($darkroomId);

        return response()->json([
            'opening_time' => $darkroom->opening_time,
            'closing_time' => $darkroom->closing_time,
        ]);
    }
}
