@php
$iconUrl = $user->icon?->getUrl();
@endphp

<x-main-layout :showprofile="false">
    <x-auth-card>
        <form method="POST" action="{{ route('users.update', Auth::user()) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div
                class="w-2/5 md:w-2/6 lg:w-2/12 flex flex-col md:items-center pb-2 md:pb-0 md:pr-2 md:text-center gap-2">
                @isset($iconUrl)
                    <x-image-input id="icon" name="icon" :initial="$iconUrl" />
                @else
                    <x-image-input id="icon" name="icon" />
                @endisset
                <x-input-label for="icon" :value="__('form.field.icon.edit')" />
                <x-input-error field="icon" class="mt-2" />
            </div>
            <div class="grid grid-cols-5 my-5">
                {{-- Name --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="name" :value="__('form.field.name')" />
                <x-text-input id="name" class="block mt-1 w-full col-span-3" type="text" name="name" :value="$user->name"
                    autofocus />
            </div>
            <x-input-error field="name" class="mt-2" />

            <div class="grid grid-cols-5 my-5">
                {{-- Surname --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="surname" :value="__('form.field.surname')" />
                <x-text-input id="surname" class="block mt-1 w-full col-span-3" type="text" name="surname" :value="$user->surname"
                    autofocus />
            </div>
                <x-input-error field="surname" class="mt-2" />
                
            <div class="grid grid-cols-5 my-5">
                {{-- Email Address --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="email" :value="__('form.field.email')" />
                <x-text-input id="email" class="block mt-1 w-full col-span-3" type="email" name="email" :value="$user->email"/>
            </div>
            <x-input-error field="email" class="mt-2" />

            <div class="grid grid-cols-5 my-5">
                {{-- Phone Number --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="phone_number" :value="__('form.field.phone_number')" />
                <x-text-input id="phone_number" class="block mt-1 w-full col-span-3" type="tel" name="phone_number"
                    :value="$user->phone_number" />
            </div>
            <x-input-error field="phone_number" class="mt-2" />

            <div class="flex items-center justify-end mt-5">
                <a href="{{ route('users.show', Auth::user()) }}" class="inline-flex items-center px-4 py-2 bg-highlight border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-highlight-light active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </a>
                <x-primary-button class="ml-5">
                    {{ __('Apply') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-main-layout>