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
        <span class="flex flex-row flex-wrap justify-start gap-2">
            @can('update', $company)
                <x-primary-link href="{{ route('companies.edit', $company->id) }}">
                    @svg('resources/images/gear.svg', 'fill-white mr-1')
                    @tr('company.edit.title')
                </x-primary-link>
            @endcan
            <x-primary-link href="{{ route('jobs.index', ['company' => $company->id]) }}">
                @tr('company.adverts')
            </x-primary-link>
        </span>
        <div class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            <span class="w-full flex flex-row flex-wrap">
                @isset($iconUrl)
                    <div
                        class="w-2/5 md:w-1/6 lg:w-1/12 flex flex-col md:items-center pb-2 md:pb-0 md:pr-2 md:text-center gap-2">
                        <img src={{ $iconUrl }} alt="icon"
                            class="aspect-square w-full shrink-0 p-1 border border-l-brd/10 border-solid rounded-xl">
                    </div>
                @endisset
                <div
                    class="w-full md:w-5/6 lg:w-11/12 border-t md:border-t-0 md:border-l border-l-brd/10 pt-2 md:pt-0 pl-2">
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
