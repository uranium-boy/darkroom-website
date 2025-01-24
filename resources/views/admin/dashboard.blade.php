
@extends('layouts.admin-app')

@section('title', 'Admin Dashboard')

@section('header')
    {{ __('Dashboard') }}
@endsection

@section('content')
    <h3 class="text-xl">Admin Overview</h3>
    <p>Welcome to the admin dashboard. Here is an overview of the current data:</p>
    <div class="mt-6">
        <div class="flex justify-between">
            <div style="background: #3b82f6" class="p-4 rounded-lg w-1/3">
                <h4 class="text-lg font-semibold">Users</h4>
                <p class="text-xl">{{ $userCount }}</p>
            </div>
            <div style="background: #22c55e" class="p-4 rounded-lg w-1/3">
                <h4 class="text-lg font-semibold">Reservations</h4>
                <p class="text-xl">{{ $reservationCount }}</p>
            </div>
        </div>
    </div>
@endsection
