@extends('layouts.admin-app')

@section('title', 'Admin Panel')

@section('header', 'Manage Darkrooms')

@section('content')
    public function index($darkroomId) {
        $reservations = Reservation::where('darkroom_id', $darkroomId)
            ->where('start_time', '>=', today())
            ->with('user')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    <div class="mt-6 mx-auto max-w-7xl">
        <table class="w-full border-separate border-spacing-0 bg-gray-800 rounded-lg border border-gray-300 text-gray-300">
            <thead class="text-lg uppercase">
            <tr class="bg-gray-500">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Start Time</th>
                <th class="border px-4 py-2">End Time</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->id }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->start_time }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->end_time }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->user->name }}</td>
                    <td class="border px-4 py-2 text-center ">
                        <form action="{{ route('admin.reservations.destroy', $darkroom->id, $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this darkroom?')">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>{{ __('Delete') }}</x-danger-button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
