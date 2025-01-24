@extends('layouts.admin-app')

@section('title', 'Admin Panel')

@section('header', 'Manage Darkrooms')

@section('content')
    {{-- Button --}}
    <x-primary-button href="{{ route('admin.darkrooms.create') }}">Add New Darkroom</x-primary-button>
    <div class="mt-6 mx-auto max-w-7xl">
        <table class="w-full border-separate border-spacing-0 bg-gray-800 rounded-lg border border-gray-300 text-gray-300">
            <thead class="text-lg uppercase">
            <tr class="bg-gray-500">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Opening Time</th>
                <th class="border px-4 py-2">Closing Time</th>
                <th class="border px-4 py-2">Operational</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($darkrooms as $darkroom)
                <tr>
                    <td class="border px-4 py-2 text-center ">{{ $darkroom->id }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $darkroom->name }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $darkroom->opening_time }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $darkroom->closing_time }}</td>
                    <td class="border px-4 py-2 text-center ">
                        {{ $darkroom->is_operational ? 'Yes' : 'No' }}
                    </td>
                    <td class="border px-4 py-2 text-center ">
                        <x-secondary-button href="{{ route('admin.darkrooms.edit', $darkroom->id) }}">
                            Edit
                        </x-secondary-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
