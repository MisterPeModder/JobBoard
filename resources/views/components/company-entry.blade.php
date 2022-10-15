{{-- A single entry in the list of companies --}}

<div {{ $attributes->merge(['id' => "company-$id"]) }}
    class="company relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-highlight">

    <span class="flex flex-row flex-wrap justify-between">
        <span class="flex flex-row gap-2">
            @isset($iconUrl)
                <a href="{{ route('companies.show', $company->id) }}" class="font-semibold hover:underline shrink-0">
                    <img src={{ $iconUrl }} alt="icon"
                        class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
                </a>
            @endisset
            <div class="border-l border-1 border-l-brd/10 pl-2">
                <a href="{{ route('companies.show', $company->id) }}"
                    class="font-semibold hover:underline">{{ $name }}</a>
                @isset($location)
                    <div>{{ $location }}</div>
                @endisset
                <x-exclusive-details class="text-sm relative">
                    <summary
                        {{ $attributes->merge(['data-open' => __('company.details.open'), 'data-close' => __('company.details.close')]) }}
                        class="marker-rotating marker-rotating-highlight text-base text-highlight hover:underline cursor-pointer">
                    </summary>
                    <p class="flex flex-col divide-y divide-solid divide-l-brd/10 gap-1">{{ $description }}</p>
                </x-exclusive-details>
            </div>

        </span>
        <span class="flex items-center justify-end w-full md:w-auto">
            <x-secondary-link href="{{ route('companies.jobs.index', $company) }}">
                @tr('company.adverts')
            </x-secondary-link>
        </span>
    </span>
</div>
