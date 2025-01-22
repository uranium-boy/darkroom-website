
@extends('layouts.admin-app')

@section('title', 'Admin Dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You are an admin.") }}
                    <h3 class="text-xl">Admin Overview</h3>
                    <p>Welcome to the admin dashboard. Here is an overview of the current data:</p>
                    <div class="mt-6">
                        <div class="flex justify-between">
                            <div class="bg-blue-500 text-white p-4 rounded-lg w-1/3">
                                <h4 class="text-lg font-semibold">Users</h4>
                                <p class="text-xl">{{ $userCount }}</p>
                            </div>
                            <div class="bg-green-500 text-white p-4 rounded-lg w-1/3">
                                <h4 class="text-lg font-semibold">Reservations</h4>
                                <p class="text-xl">{{ $reservationCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
