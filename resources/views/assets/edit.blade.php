{{-- Edit properties of an asset, admin only  --}}

@php
$blobUrl = $asset->getUrl();
@endphp

<x-main-layout :title="__('admin.asset.title')">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row justify-start gap-2">
            <x-secondary-link :admin="true" href="{{ route('assets.index') }}" class="group">
                @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                @tr('admin.assets.title')
            </x-secondary-link>
        </span>

        {{-- General Information Section --}}
        <form method="POST" action="{{ route('assets.update', $asset->id) }}" enctype="multipart/form-data"
            class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            @method('PATCH')
            @csrf

            <div class="w-full flex flex-row flex-wrap">
                <div
                    class="w-2/5 md:w-1/6 lg:w-2/12 flex flex-col md:items-center pb-2 md:pb-0 md:pr-2 md:text-center gap-2">
                    @if (Str::startsWith($asset->mime_type, 'image/'))
                        <img src="{{ $blobUrl }}" alt="icon"
                            class="aspect-auto h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
                    @else
                        <p
                            class="aspect-auto h-20 p-1 border border-l-brd/10 border-solid rounded-xl italic flex items-center">
                            {{ __('asset.no_preview') }}
                        </p>
                    @endif

                    <a href="{{ $blobUrl }}" class="text-sm hover:underline">{{ $asset->blob->uuid }}</a>
                </div>
                <div
                    class="w-full md:w-5/6 lg:w-10/12 border-t md:border-t-0 md:border-l border-l-brd/10 pt-2 md:pt-0 pl-2">
                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('form.field.name') . '*'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="$asset->name" required autofocus />
                        <x-input-error field="name" class="mt-2" />
                    </div>

                    {{-- Blob ID --}}
                    <div class="mt-4">
                        <x-input-label for="blob-id" :value="__('form.field.blob_id') . '*'" />
                        <x-text-input id="blob-id" class="block mt-1 w-full" type="text" name="blob-id"
                            :value="$asset->blob_id" autofocus />
                        <x-input-error field="blob-id" class="mt-2" />
                    </div>

                    {{-- MIME Type --}}
                    <div class="mt-4">
                        <x-input-label for="mime-type" :value="__('form.field.mime_type') . '*'" />
                        <x-text-input id="mime-type" class="block mt-1 w-full" type="text" name="mime-type"
                            :value="$asset->mime_type" autofocus />
                        <x-input-error field="mime-type" class="mt-2" />
                    </div>

                    {{-- Creation Date --}}
                    <div class="mt-4">
                        <x-input-label for="creation-date" :value="__('form.field.creation_date') . '*'" />
                        <x-text-input id="creation-date" class="block mt-1 w-full" type="text" name="creation-date"
                            :value="$asset->created_at" autofocus />
                        <x-input-error field="creation-date" class="mt-2" />
                    </div>

                    {{-- User --}}
                    <div class="mt-4">
                        <x-input-label for="user" :value="__('form.field.user')" />
                        <x-text-input id="user" class="block mt-1 w-full" type="email" name="user"
                            :value="$asset->user?->email" autofocus placeholder="{{ __('form.not_set') }}" />
                        <x-input-error field="user" class="mt-2" />
                    </div>

                    {{-- Company --}}
                    <div class="mt-4">
                        <x-input-label for="company-id" :value="__('form.field.company_id')" />
                        <x-text-input id="company-id" class="block mt-1 w-full" type="text" name="company-id"
                            :value="$asset->company_id" autofocus placeholder="{{ __('form.not_set') }}" />
                        <x-input-error field="company-id" class="mt-2" />
                    </div>

                    {{-- Access --}}
                    <div class="mt-4">
                        <x-input-label for="access" :value="__('form.field.access') . '*'" />
                        <x-select id="access" name="access">
                            <option value="public" @selected($asset->access === 'public')>
                                {{ __('asset.access.public') }}
                            </option>
                            <option value="private" @selected($asset->access === 'private')>
                                {{ __('asset.access.private') }}
                            </option>
                        </x-select>
                    </div>

                    <div><em class="w-full">@tr('form.field.required_hint')</em></div>
                </div>

                <div class="w-full flex items-center justify-end mt-4">
                    <x-primary-button :admin="true" class="ml-4">
                        @tr('admin.asset')
                    </x-primary-button>
                </div>
            </div>
        </form>

        {{-- Danger Zone Section --}}
        <form method="POST" action="{{ route('assets.update', $asset->id) }}"
            class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            @method('DELETE')
            @csrf

            <h2 class="font-semibold pb-2">{{ 'Danger Zone' }}</h2>

            <x-primary-button :admin="true" class="ml-4 flex flex-row gap-2">
                @svg('resources/images/delete.svg', 'fill-white')
                @tr('asset.delete')
            </x-primary-button>
        </form>
    </main>
</x-main-layout>
