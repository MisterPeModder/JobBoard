<x-main-layout :showprofile="false">
    <x-auth-card>
        <form method="POST" action="{{ route('users.update', Auth::user()) }}">
            @method('PUT')
            @csrf
            
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
                <x-primary-button class="ml-5">
                    {{ __('Apply') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-main-layout>