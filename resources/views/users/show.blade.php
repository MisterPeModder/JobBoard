<x-main-layout>
    <x-auth-card>
    {{-- Data stored in users table shown here --}}
        <div class="text-lg p-5">
            <div class="flex justify-between p-5 mx-5">
                <p>Name:</p>
                <p>{{ $user->name }}</p>
            </div>
            <div class="text-lg p-5">
            <div class="flex justify-between p-5 mx-5">
                <p>Surname:</p>
                <p>{{ $user->surname }}</p>
            </div>
            <div class="text-lg p-5">
            <div class="flex justify-between p-5 mx-5">
                <p>Email:</p>
                <p>{{ $user->email }}</p>
            </div>
            <div class="text-lg p-5">
            <div class="flex justify-between p-5 mx-5">
                <p>Phone number:</p>
                <p>{{ $user->phone_number }}</p>
            </div>


    {{-- "Edit" widget, button to edit profile --}}
    <div class="flex items-center justify-end mt-4">
    <a href="{{ route('users.edit', Auth::user()) }}"
        class="inline-flex items-center px-4 py-2 bg-highlight border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-highlight-light active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        Edit</a>
    </div>
    </x-auth-card>
</x-main-layout>