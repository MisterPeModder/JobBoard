<x-main-layout :showprofile="false">
    <x-auth-card>
        <h1 class="text-center">My Profile</h1>
        {{-- Data stored in users table shown here --}}
        <div class="pt-5 my-10 grid grid-cols-5">
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
            <a href="{{ route('users.edit', Auth::user()) }}"
                class="inline-flex items-center px-4 py-3 bg-highlight border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-highlight-light active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-23 transition ease-in-out duration-150">
                Edit</a>
        </div>
    </x-auth-card>
</x-main-layout>