@extends('layouts.guest-app')

@section('title', 'Calendar')

@section('header')
    <h1>Calendar test</h1>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Tutaj wstaw opis coś tam coś tam</p>
                    <div id="calendar"></div>
                    {{--
                                        {{ __("You're logged in!") }}
                    --}}
                </div>
            </div>
        </div>
    </div>
@endsection

