@extends('layouts.admin-app')

@section('title', 'Admin Panel')

@section('header')
    {{ isset($darkroom) ? 'Edit Darkroom' : 'Add New Darkroom' }}
@endsection

@section('content')
    <form action="{{ isset($darkroom) ? route('admin.darkrooms.update', $darkroom) : route('admin.darkrooms.store') }}" method="POST">
        @csrf
        @if(isset($darkroom))
            @method('PUT')
        @endif

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $darkroom->name ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="opening_time" :value="__('Opening Time')" />
            <x-text-input id="opening_time" class="block mt-1 w-full" type="time" name="opening_time" :value="old('opening_time', $darkroom->opening_time ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="closing_time" :value="__('Closing Time')" />
            <x-text-input id="closing_time" class="block mt-1 w-full" type="time" name="closing_time" :value="old('closing_time', $darkroom->closing_time ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="is_operational" :value="__('Is Operational')" />
            <input type="hidden" name="is_operational" value="0">
            <x-text-input id="is_operational" class="block mt-1" type="checkbox" name="is_operational" value="1" :checked="old('is_operational', $darkroom->is_operational ?? false) == true" />
        </div>
        <x-primary-button>{{ isset($darkroom) ? 'Update' : 'Create' }}</x-primary-button>
    </form>

    @if(isset($darkroom))
        <form action="{{ route('admin.darkrooms.destroy', $darkroom) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this darkroom?')">
            @csrf
            @method('DELETE')
            <x-danger-button>{{ __('Delete') }}</x-danger-button>
        </form>
    @endif
@endsection
