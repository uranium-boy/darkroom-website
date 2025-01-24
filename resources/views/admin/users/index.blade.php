@extends('layouts.admin-app')

@section('title', 'Admin Panel')

@section('header', 'Manage Users')

@section('content')
    {{-- Button --}}
    <x-primary-button href="{{ route('admin.users.create') }}">Add New User</x-primary-button>
    <div class="mt-6 mx-auto max-w-7xl">
        <table class="w-full border-separate border-spacing-0 bg-gray-800 rounded-lg border border-gray-300 text-gray-300">
            <thead class="text-lg uppercase">
            <tr class="bg-gray-500">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Telephone</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2 text-center ">{{ $user->id }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $user->name }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $user->email }}</td>
                    <td class="border px-4 py-2 text-center ">{{ $user->telephone }}</td>
                    <td class="border px-4 py-2 text-center ">
                        <x-secondary-button href="{{ route('admin.users.edit', $user->id) }}">
                            Edit
                        </x-secondary-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
