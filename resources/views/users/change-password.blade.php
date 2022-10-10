<x-main-layout :showprofile="false">
    <x-auth-card>
        <h1 class="text-center">Change password</h1>
        <form method="POST" action="{{ route('update-password', Auth::user()) }}">
            @method('PUT')
            @csrf

            {{-- Old password --}}
            <div class="grid grid-cols-5 my-5">
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="oldpassword" value="Old password" />
                <x-text-input id="oldpassword" class="block mt-1 w-full col-span-3" type="password" name="oldpassword"/>
            </div>
            <x-input-error field="oldpassword" class="mt-2" />

            {{-- New password --}}
            <div class="grid grid-cols-5 my-5">
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="newpassword" value="New password" />
                <x-text-input id="newpassword" class="block mt-1 w-full col-span-3" type="password" name="newpassword"/>
            </div>
            <x-input-error field="newpassword" class="mt-2" />

            {{-- Confirm new password --}}
            <div class="grid grid-cols-5 my-5">
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="newpassword_confirmation" value="Confirm new password" />
                <x-text-input id="newpassword_confirmation" class="block mt-1 w-full col-span-3" type="password" name="newpassword_confirmation"/>
            </div>
            <x-input-error field="newpassword_confirmation" class="mt-2" />

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