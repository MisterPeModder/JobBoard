@php
$iconUrl = $user->icon?->getUrl();
$ownProfile = Auth::user()?->id === $user->id;
$title = __('user.profile' . ($ownProfile ? '.you' : ''));
@endphp

<x-main-layout :showprofile="!$ownProfile" :title="$title">
    <x-auth-card>
        <h1 class="text-center font-bold text-xl">
            {{ $title }}
        </h1>
        {{-- Data stored in users table shown here --}}
        <div>
            @isset($iconUrl)
                <img src={{ $iconUrl }} alt="icon"
                    class="aspect-square p-1 border border-l-brd/10 border-solid rounded-full h-[4em]">
            @endisset
        </div>
        <div class="pt-5 my-2 grid grid-cols-5">
            <p class="col-span-2">{{ __('form.field.name') }}</p>
            <p class="col-span-3">{{ $user->name }}</p>
        </div>
        <div class="my-10 grid grid-cols-5">
            <p class="col-span-2">{{ __('form.field.surname') }}</p>
            <p class="col-span-3">{{ $user->surname }}</p>
        </div>
        <div class="my-10 grid grid-cols-5">
            <p class="col-span-2">{{ __('form.field.email') }}</p>
            <p class="col-span-3">{{ $user->email }}</p>
        </div>
        <div class="my-10 grid grid-cols-5">
            <p class="col-span-2">{{ __('form.field.phone_number') }}</p>
            <p class="col-span-3">{{ $user->phone_number }}</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- "Change password" widget, button to edit password --}}
            <a href="{{ route('change-password') }}"
                class="inline-flex items-center mx-4 px-4 py-3 bg-highlight border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-highlight-light active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-23 transition ease-in-out duration-150">
                Change password</a>
            {{-- "Edit" widget, button to edit profile --}}
            <a href="{{ route('users.edit', $user) }}"
                class="inline-flex items-center px-4 py-3 bg-highlight border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-highlight-light active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-23 transition ease-in-out duration-150">
                Edit</a>
        </div>
    </x-auth-card>
</x-main-layout>
