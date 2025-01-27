<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Your reservations:</h1>
                    @if ($reservations->isEmpty())
                        <p>You have no upcoming reservations.</p>
                        <div class="mt-3">
                            <x-primary-button href="{{ route('reservations') }}">{{ 'Make a reservation' }}</x-primary-button>
                        </div>
                    @else
                        <div class="mt-6 mx-auto max-w-7xl">
                            <table class="w-full border-separate border-spacing-0 bg-gray-800 rounded-lg border border-gray-300 text-gray-300">
                                <thead class="text-lg uppercase">
                                <tr class="bg-gray-500">
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Darkroom</th>
                                    <th class="border px-4 py-2">Date</th>
                                    <th class="border px-4 py-2">Start Time</th>
                                    <th class="border px-4 py-2">End Time</th>
                                    <th class="border px-4 py-2">Created At</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td class="border px-4 py-2 text-center ">{{ $reservation->id }}</td>
                                        <td class="border px-4 py-2 text-center ">{{ $reservation->darkroom->name }}</td>
                                        <td class="border px-4 py-2 text-center ">{{ $reservation->start_time->format('d-m-Y') }}</td>
                                        <td class="border px-4 py-2 text-center ">{{ $reservation->start_time->format('H:i') }}</td>
                                        <td class="border px-4 py-2 text-center ">{{ $reservation->end_time->format('H:i') }}</td>
                                        <td class="border px-4 py-2 text-center ">{{ $reservation->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="border px-4 py-2 text-center ">
                                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
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
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
