@php
$iconUrl = $user->icon?->getUrl();
@endphp

<x-main-layout :showprofile="!$admin">
    <x-auth-card>
        @if ($admin)
            <span class="flex flex-row justify-start gap-2 mb-2">
                <x-secondary-link :admin="true" href="{{ route('users.index') }}" class="group">
                    @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                    @tr('admin.users.title')
                </x-secondary-link>
            </span>
        @endif

        <h1 class="text-center font-bold text-xl">
            {{ __('user.profile.edit' . ($admin ? '.admin' : '')) }}
        </h1>
        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            @if ($admin)
                <input type="hidden" name="admin" value="1">
            @endif

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
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="name"
                    :value="__('form.field.name')" />
                <x-text-input id="name" class="block mt-1 w-full col-span-3" type="text" name="name"
                    :value="$user->name" autofocus />
            </div>
            <x-input-error field="name" class="mt-2" />

            <div class="grid grid-cols-5 my-5">
                {{-- Surname --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="surname"
                    :value="__('form.field.surname')" />
                <x-text-input id="surname" class="block mt-1 w-full col-span-3" type="text" name="surname"
                    :value="$user->surname" autofocus />
            </div>
            <x-input-error field="surname" class="mt-2" />

            <div class="grid grid-cols-5 my-5">
                {{-- Email Address --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="email"
                    :value="__('form.field.email')" />
                <x-text-input id="email" class="block mt-1 w-full col-span-3" type="email" name="email"
                    :value="$user->email" />
            </div>
            <x-input-error field="email" class="mt-2" />

            <div class="grid grid-cols-5 my-5">
                {{-- Phone Number --}}
                <x-input-label class="flex items-center text-base font-normal col-span-2" for="phone_number"
                    :value="__('form.field.phone_number')" />
                <x-text-input id="phone_number" class="block mt-1 w-full col-span-3" type="tel" name="phone_number"
                    :value="$user->phone_number" />
            </div>
            <x-input-error field="phone_number" class="mt-2" />

            <div class="flex flex-row flex-wrap items-center mt-5 justify-between">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @method('DELETE')
                    @csrf

                    <x-primary-button :disabled="$user->is_admin && $user->id === Auth::user()->id" :admin="$admin" class="flex flex-row gap-2">
                        @svg('resources/images/delete.svg', 'fill-white')
                        @tr('user.delete')
                    </x-primary-button>
                </form>

                <div class="flex items-center justify-end">
                    <x-secondary-link :admin="$admin" href="{{ route('users.show', $user) }}">
                        {{ __('Cancel') }}
                    </x-secondary-link>
                    <x-primary-button :admin="$admin" class="ml-5">
                        {{ __('Apply') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-main-layout>
