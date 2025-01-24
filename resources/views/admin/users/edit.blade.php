@extends('layouts.admin-app')

@section('title', 'Admin Panel')

@section('header')
    {{ isset($user) ? 'Edit User' : 'Add New User' }}
@endsection

@section('content')
    <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="telephone" :value="__('Telephone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone', $user->telephone ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="street_address" :value="__('Street Address')" />
            <x-text-input id="street_address" class="block mt-1 w-full" type="text" name="street_address" :value="old('street_address', $user->street_address ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $user->city ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $user->postal_code ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="birthdate" :value="__('Birthdate')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate', $user->birthdate ?? '')" required />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="mb-4">
            <x-input-label for="is_admin" :value="__('Is Admin')" />
            <input type="hidden" name="is_admin" value="0">
            <x-text-input id="is_admin" class="block mt-1" type="checkbox" name="is_admin" :checked="old('is_admin', $user->is_admin ?? false)==true" />
        </div>
        <div class="flex">
            <div class="mt-2 mr-2">
                <x-primary-button>{{ isset($user) ? 'Update' : 'Create' }}</x-primary-button>
            </div>
            <div class="mt-2 mr-2">
                <x-secondary-button href="{{ route('admin.users.index') }}">Return</x-secondary-button>
            </div>
        </div>
    </form>

    @if(isset($user))
        <form class="mt-2 mr-2" action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
            @csrf
            @method('DELETE')
            <x-danger-button>{{ __('Delete') }}</x-danger-button>
        </form>
    @endif
@endsection
