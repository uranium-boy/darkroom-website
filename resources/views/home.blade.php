@extends('layouts.main')

@section('title', 'Test')

@section('header')
    <h1>Test</h1>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Nasza ciemnia coś tam</p>
                    <h1>Kalendarz:</h1>
{{--
                    {{ __("You're logged in!") }}
--}}
                </div>
            </div>
        </div>
    </div>
@endsection

