{{-- A single entry in the list of companies --}}

<div {{ $attributes->merge(['id' => "company-$id"]) }}
    class="company relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-highlight">

    <span class="flex flex-row gap-2">
        @isset($iconUrl)
            <img src={{ $iconUrl }} alt="icon"
                class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
        @endisset
        <div class="border-l border-1 border-l-brd/10 pl-2">
            <h2 class="font-semibold">{{ $name }}</h2>
            @isset($location)
                <div>{{ $location }}</div>
            @endisset
            <details class="text-sm relative">
                <summary
                    {{ $attributes->merge(['data-open' => __('company.details.open'), 'data-close' => __('company.details.close')]) }}
                    class="marker-rotating marker-rotating-highlight text-base text-highlight hover:underline cursor-pointer">
                </summary>
                <p class="flex flex-col divide-y divide-solid divide-l-brd/10 gap-1">{{ $description }}</p>
            </details>
        </div>
    </span>
</div>
