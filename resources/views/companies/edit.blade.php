{{-- The list of companies in the 'GET /companies' route --}}

@php
$id = $company->id;
$name = $company->name;
$description = $company->description;

if ($company->location !== null) {
    $location = $company->location;
}

$iconUrl = $company->icon?->getUrl();
@endphp

<x-main-layout :title="__('company.list.title')">
    <main class="container mx-auto py-2 divide-y divide-l-brd/10 flex flex-col gap-2 px-2">
        <span class="flex flex-row justify-start">
            <x-primary-link href="{{ route('companies.show', ['company' => $company->id]) }}">
                &#10094; @tr('company.show')
            </x-primary-link>
        </span>
        <div class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            <span class="flex flex-row gap-2">
                @isset($iconUrl)
                    <img src={{ $iconUrl }} alt="icon"
                        class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
                @endisset
                <div class="border-l border-1 border-l-brd/10 pl-2">
                    <h1 class="font-bold text-xl">{{ $name }}</h1>
                    @isset($location)
                        <div>
                            <h2 class="font-semibold">Location</h2>
                            {{ $location }}
                        </div>
                    @endisset
                    <div>
                        <h2 class="font-semibold">Description</h2>
                        <p class="flex flex-col divide-y divide-solid divide-l-brd/10 gap-1">{{ $description }}</p>
                    </div>
                </div>
            </span>
        </div>
    </main>
</x-main-layout>
