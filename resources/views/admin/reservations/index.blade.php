@extends('layouts.admin-app')

@section('title', 'Admin Panel')

@section('header', 'Manage Darkrooms')

@section('content')
    <form action="{{ route('admin.reservations.index') }}" method="GET">
        <label for="darkroom-dropdown">Select a Darkroom:</label>
        <select name="darkroom_id" id="darkroom-dropdown" onchange="this.form.submit()" class="block w-1/3 px-4 py-2 bg-gray-800 border border-gray-500 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-gray-800 transition ease-in-out duration-150" id="darkrooms-dropdown">
            @foreach($darkrooms as $darkroom)
                <option value="{{ $darkroom->id }}" {{ $darkroom->id == $selectedDarkroomId ? 'selected' : '' }}>
                    {{ $darkroom->name }}
                </option>
            @endforeach
        </select>

        <div class="mt-3">
            @if (request('past'))
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    Show Future Reservations
                </button>
            @else
                <button type="submit" name="past" value="true" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    Show Past Reservations
                </button>
            @endif
        </div>
    </form>

    <div class="mt-6 mx-auto max-w-7xl">
        <table class="w-full border-separate border-spacing-0 bg-gray-800 rounded-lg border border-gray-300 text-gray-300">
            <thead class="text-lg uppercase">
            <tr class="bg-gray-500">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Start Time</th>
                <th class="border px-4 py-2">End Time</th>
                <th class="border px-4 py-2">Created At</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->id }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->start_time->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->start_time->format('H:i') }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->end_time->format('H:i') }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->created_at->format('d-m-Y H:i') }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $reservation->user->name }}</td>
                    <td class="border px-4 py-2 text-center ">
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?')">
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
