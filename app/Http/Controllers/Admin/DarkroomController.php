<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Darkroom;
use Illuminate\Http\Request;

class DarkroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $darkrooms = Darkroom::all();

        return view('admin.darkrooms.index', compact('darkrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.darkrooms.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:darkrooms',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'is_operational' => 'required|boolean',
        ]);

        Darkroom::create($request->all());

        return redirect()->route('admin.darkrooms.index')->with('success', 'Darkroom created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $darkroom = Darkroom::findOrFail($id);

        return view('admin.darkrooms.edit', compact('darkroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $darkroom = Darkroom::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:darkrooms,name,'.$darkroom->id,
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'is_operational' => 'required|boolean',
        ]);
        $darkroom->update($request->all());

        return redirect()->route('admin.darkrooms.index')->with('success', 'Darkroom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $darkroom = Darkroom::findOrFail($id);
        $darkroom->delete();

        return redirect()->route('admin.darkrooms.index')->with('success', 'Darkroom deleted successfully');
    }
}
