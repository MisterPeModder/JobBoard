<x-main-layout :title="__('advert.apply.title')">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row justify-between">
            <h1 class="font-semibold text-xl">@tr('advert.apply.title')</h1>
        </span>
        <section
            class="mx-auto p-2 my-2 w-full bg-l-bgr-content rounded-md border-2 shadow-md overflow-hidden flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <h1 class="font-semibold">{{ $advert->title }}</h1>
            <form method="POST" action="{{ route('jobs.apply.store', $advert->id) }}" enctype="multipart/form-data"
                class="w-full">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('form.field.name') . '*'" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="Auth::guest() ? old('name') : Auth::user()->name" :readonly="Auth::check()" required autofocus />
                    <x-input-error field="name" class="mt-2" />
                </div>

                <!-- Surname -->
                <div>
                    <x-input-label for="surname" :value="__('form.field.surname')" />
                    <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                        :value="Auth::guest() ? old('surname') : Auth::user()->surname" :readonly="Auth::check() && Auth::user()->surname != null" autofocus />
                    <x-input-error field="surname" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('form.field.email') . '*'" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="Auth::guest() ? old('email') : Auth::user()->email" :readonly="Auth::check()" required />
                    <x-input-error field="email" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div class="mt-4">
                    <x-input-label for="phone-number" :value="__('form.field.phone_number')" />
                    <x-text-input id="phone-number" class="block mt-1 w-full" type="tel" name="phone-number"
                        :readonly="Auth::check() && Auth::user()->phone_number != null" :value="Auth::guest() ? old('phone-number') : Auth::user()->phone_number" />
                    <x-input-error field="phone-number" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="message" :value="__('form.field.message') . '*'" />
                    <x-text-area id="message" class="block mt-1 w-full" name="message">
                        {{ old('message') }}
                    </x-text-area>
                    <x-input-error field="message" class="mt-2" />
                </div>

                <label for="attachments" class="w-full">@tr('form.field.attachments')</label>
                <input id="attachments" class="w-full" name="attachments[]" type="file" multiple
                    accept="image/jpeg,image/png,image/webp,application/pdf,application/msword,application/vnd.oasis.opendocument.text">
                <div class="flex flex-col">
                    <x-input-error field="attachments" />
                    <x-input-error field="attachments.0" />
                    <x-input-error field="attachments.1" />
                    <x-input-error field="attachments.2" />
                </div>


                <div class="flex items-center justify-between mt-4">
                    <div><em class="w-full">@tr('form.field.required_hint')</em></div>

                    <x-primary-button class="ml-4">
                        @tr('advert.apply')
                    </x-primary-button>
                </div>
            </form>
        </section>
    </main>
</x-main-layout>
