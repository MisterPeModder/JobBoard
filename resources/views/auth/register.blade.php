<x-blank-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Icon -->
            <div
            class="w-2/5 md:w-2/6 lg:w-4/12 flex flex-col md:items-center pb-2 md:pb-0 md:pr-2 md:text-center gap-2">
            <x-input-label for="icon" :value="__('form.field.icon')" />
            @isset($iconUrl)
                <x-image-input id="icon" name="icon" :initial="$iconUrl" />
            @else
                <x-image-input id="icon" name="icon" />
            @endisset
            <x-input-error field="icon" class="mt-2" />
           </div>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('form.field.name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error field="name" class="mt-2" />
            </div>

            <!-- Surname -->
            <div>
                <x-input-label for="surname" :value="__('form.field.surname')" />
                <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')"
                    autofocus />
                <x-input-error field="surname" class="mt-2" />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('form.field.email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error field="email" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('form.field.phone_number')" />
                <x-text-input id="phone-number" class="block mt-1 w-full" type="tel" name="phone-number"
                    :value="old('phone-number')" />
                <x-input-error field="phone-number" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('form.field.password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error field="password" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('form.field.confirm_password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />

                <x-input-error field="password_confirmation" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-blank-layout>
