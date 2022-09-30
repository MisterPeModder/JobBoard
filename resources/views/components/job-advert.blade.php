{{-- A job advert component with a collapsible description --}}

<div {{ $attributes->merge(['id' => "advert-$id"]) }}
    class="relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-highlight flex flex-col">

    <span class="flex flex-row gap-2 items-start justify-between">
        <div class="flex flex-row gap-2">
            @isset($icon)
                <img src="{{ Vite::asset($icon) }}" alt="icon"
                    class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
            @endisset
            <div>
                <h2 class="font-semibold">{{ $title }}</h2>
                <div class="hover:no-underline">{{ $company }}</div>
                <div class="">{{ $location }}</div>
            </div>
        </div>
        <button {{ $attributes->merge(['id' => "advert-$id-options"]) }} type="button" aria-label="advert options"
            class="advert-options">
            <img src="{{ Vite::asset('resources/images/three-dots.svg') }}" alt="advert options">
        </button>
    </span>
    <ol class="list-disc list-inside border-y border-solid border-l-brd/10 my-2 py-2">
        {{ $shortDescription }}
    </ol>
    <details class="text-sm relative">
        <summary data-open="Learn more" data-close="Collapse"
            class="marker-rotating marker-rotating-highlight text-base text-highlight hover:underline cursor-pointer">
        </summary>
        <div class="flex flex-col divide-y divide-solid divide-l-brd/10 gap-1">
            <div>
                <h2 class="text-base font-semibold py-2">Job Details</h2>
                <div>
                    <h3 class="font-semibold inline">Salary:</h3>
                    <p class="inline">{{ $salary }}</p>
                </div>
                <div>
                    <h3 class="font-semibold inline">Type:</h3>
                    <p class="inline">{{ $jobType }}</p>
                </div>
            </div>
            <div class="pt-1">
                <h2 class="text-base font-semibold py-2">Full Description</h2>
                <p>{{ $fullDescription }}</p>
            </div>
        </div>
        <span class="mt-2 flex flex-row gap-2 items-center">
            <button {{ $attributes->merge(['id' => "advert-$id-apply"]) }} type="button" aria-label="apply now"
                class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold">Apply
                now</button>
            <button {{ $attributes->merge(['id' => "advert-$id-fav"]) }} type="button" aria-label="save to favorites"
                class="bg-slate-400 rounded-xl p-2 text-sm flex items-center justify-center whitespace-nowrap font-semibold">
                @svg('resources/images/star-outline.svg', 'fill-white hover:fill-yellow-200 ease-in-out duration-150')
            </button>
        </span>
    </details>
</div>
