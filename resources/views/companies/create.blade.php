{{-- Create company form for the 'GET /companies/create' route --}}

<x-main-layout :title="__($admin ? 'company.create.title.admin' : 'company.create.title')">
    <main
        class="mx-auto p-2 my-2 w-11/12 md:w-10/12 lg:w-1/2 bg-l-bgr-content rounded-md border-2 shadow-md overflow-hidden flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <span class="w-full py-2 flex flex-row justify-between">
            @if ($admin)
                <x-secondary-link :admin="true" href="{{ route('companies.index', ['admin' => '1']) }}"
                    class="group">
                    @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                    @tr('company.list.title.admin')
                </x-secondary-link>
            @else
                <x-secondary-link href="{{ route('companies.index') }}" class="group">
                    @svg('resources/images/left-angle.svg', 'fill-highlight group-hover:fill-highlight-light mr-1')
                    @tr('company.list.title')
                </x-secondary-link>
            @endif
        </span>

        <h1 class="font-semibold text-xl">
            @if ($admin)
                @tr('company.create.title.admin')
            @else
                @tr('company.create.title')
            @endif
        </h1>

        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data"
            class="w-full flex flex-row flex-wrap">
            @csrf

            @if ($admin)
                <input type="hidden" name="admin" value="1">
            @endif

            <div class="w-2/5 md:w-1/6 flex flex-col md:items-center pb-2 md:pb-0 md:pr-2 md:text-center gap-2">
                <x-input-label for="icon" :value="__('form.field.icon')" />
                <x-image-input id="icon" name="icon" />
                <x-input-error field="icon" class="mt-2" />
            </div>

            <div class="w-full md:w-5/6 border-t md:border-t-0 md:border-l border-l-brd/10 pt-2 md:pt-0 pl-2">
                {{-- Name --}}
                <div>
                    <x-input-label for="name" :value="__('form.field.name') . '*'" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus />
                    <x-input-error field="name" class="mt-2" />
                </div>

                {{-- Location --}}
                <div class="mt-4">
                    <x-input-label for="location" :value="__('form.field.location')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                        :value="old('location')" autofocus />
                    <x-input-error field="location" class="mt-2" />
                </div>

                {{-- Description --}}
                <div class="mt-4">
                    <x-input-label for="description" :value="__('form.field.description') . '*'" />
                    <x-text-area id="description" class="block mt-1 w-full" name="description">
                        {{ old('description') }}
                    </x-text-area>
                    <x-input-error field="description" class="mt-2" />
                </div>

                {{-- Creation Date --}}
                @if ($admin)
                    <div class="mt-4">
                        <x-input-label for="creation-date" :value="__('form.field.creation_date') . '*'" />
                        <x-text-input id="creation-date" class="block mt-1 w-full" type="text" name="creation-date"
                            :value="now()" autofocus />
                        <x-input-error field="creation-date" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="owner" :value="__('form.field.owner') . '*'" />
                        <x-text-input id="owner" class="block mt-1 w-full" type="email" name="owner"
                            :value="Auth::user()->email" autofocus />
                        <x-input-error field="owner" class="mt-2" />
                    </div>
                @endif

                <div><em class="w-full">@tr('form.field.required_hint')</em></div>
            </div>

            <div class="w-full flex items-center justify-end mt-4">
                <x-primary-button :admin="$admin" class="ml-4">
                    @tr('company.create')
                </x-primary-button>
            </div>
        </form>
    </main>
</x-main-layout>
