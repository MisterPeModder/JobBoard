{{-- A single entry in the list of admin assets --}}

@props(['asset'])

@php
$assetUrl = route('assets.show', $asset);
$blobUrl = $asset->getUrl();
$blob = $asset->blob;
$user = $asset->user;
$company = $asset->company;
@endphp

<div {{ $attributes->merge(['id' => "asset-$asset->id"]) }}
    class="asset relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-highlight">

    <div class="flex flex-row flex-wrap gap-2">
        <a href="{{ $blobUrl }}" class="hover:underline shrink-0 flex">
            @if (Str::startsWith($asset->mime_type, 'image/'))
                <img src="{{ $blobUrl }}" alt="icon"
                    class="aspect-auto h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
            @else
                <p class="aspect-auto h-20 p-1 border border-l-brd/10 border-solid rounded-xl italic flex items-center">
                    {{ __('asset.no_preview') }}
                </p>
            @endif
        </a>

        <div class="border-l border-1 border-l-brd/10 pl-2 grid gap-1 items-baseline">
            <a href="{{ $assetUrl }}" class="font-semibold hover:underline col-span-2">
                <h2>{{ "#$asset->id: $asset->name" }}</h2>
            </a>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.mime_type')</h3>
            <p>{{ $asset->mime_type }}</p>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.blob')</h3>
            <a href="{{ $blobUrl }}" class="hover:underline">{{ "$blob->uuid (#$blob->id)" }}</a>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.created_at')</h3>
            <p>{{ $asset->created_at }}</p>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.updated_at')</h3>
            <p>{{ $asset->updated_at }}</p>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.user')</h3>
            <p>
                @isset($asset->user)
                    @php
                        $user = $asset->user;
                    @endphp
                    {{ ($user->name !== null ? "$user->name " : '') . ($user->surname !== null ? "$user->surname " : '') . "<$user->email> (#$user->id)" }}
                @else
                    {{ __('form.not_set') }}
                @endisset
            </p>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.company')</h3>
            <p>
                @isset($asset->company)
                    @php
                        $company = $asset->company;
                    @endphp
                    {{ "$company->name (#$company->id)" }}
                @else
                    {{ __('form.not_set') }}
                @endisset
            </p>

            <h3 class="col-start-1 text-base font-semibold">@tr('asset.access')</h3>
            <p>
                {{ __("asset.access.$asset->access") }}
            </p>
        </div>
    </div>
</div>
