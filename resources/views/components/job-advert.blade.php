{{-- A job advert component with a collapsible description --}}

<div {{ $attributes->merge(['id' => "advert-$id"]) }}
    class="advert relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-highlight flex flex-col">

    <span class="flex flex-row gap-2 items-start justify-between">
        <div class="flex flex-row gap-2">
            @isset($iconUrl)
                <img src={{ $iconUrl }} alt="icon"
                    class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
            @endisset
            <div>
                <h2 class="font-semibold">{{ $title }}</h2>
                <a href="{{ $companyUrl }}" class="hover:underline">{{ $company }}</a>
                @isset($location)
                    <div>{{ $location }}</div>
                @endisset
            </div>
        </div>
        <button id="{{ 'advert-' . $id . '-options' }}" type="button" aria-label="advert options" class="advert-options">
            <img src="{{ Vite::asset('resources/images/three-dots.svg') }}" alt="advert options">
        </button>
    </span>
    <ol class="list-disc list-inside border-y border-solid border-l-brd/10 my-2 py-2">
        @foreach ($shortDescription as $shortDescLine)
            <li>{{ $shortDescLine }}</li>
        @endforeach
    </ol>
    <x-exclusive-details class="text-sm relative">
        <summary data-open="{{ __('advert.details.open') }}" data-close="{{ __('advert.details.close') }}"
            class="marker-rotating marker-rotating-highlight text-base text-highlight hover:underline cursor-pointer">
        </summary>
        <div class="flex flex-col divide-y divide-solid divide-l-brd/10 gap-1">
            <div>
                <h2 class="text-base font-semibold py-2">@tr('advert.details')</h2>
                @if ($salaryMin !== null)
                    <div>
                        <h3 class="font-semibold inline">@tr('advert.details.salary')</h3>
                        <p class="inline">
                            @if ($salaryMax === null)
                                {{ "$salaryMin " . __($salaryType) }}
                            @else
                                {{ "$salaryMin to $salaryMax " . __($salaryType) }}
                            @endif
                        </p>
                    </div>
                @endif
                @isset($jobType)
                    <div>
                        <h3 class="font-semibold inline">@tr('advert.details.type')</h3>
                        <p class="inline">@tr($jobType)</p>
                    </div>
                @endisset
            </div>
            <div class="pt-1">
                <h2 class="text-base font-semibold py-2">@tr('advert.full_description')</h2>
                <p>{{ $fullDescription }}</p>
            </div>
        </div>
        <span class="mt-2 flex flex-row gap-2 items-center">
            <x-primary-link id="{{ 'advert-' . $id . '-apply' }}" title="{{ __('advert.apply') }}"
                href="{{ route('jobs.apply.create', $id) }}">
                @tr('advert.apply')
            </x-primary-link>
            <button id="{{ 'advert-' . $id . '-fav' }}" title="{{ __('advert.favorite') }}" type="button"
                aria-label="save to favorites"
                class="group bg-slate-400 rounded-xl p-2 text-sm flex items-center justify-center whitespace-nowrap font-semibold">
                @svg('resources/images/star-outline.svg', 'fill-white group-hover:fill-yellow-200 ease-in-out duration-150')
            </button>
        </span>
    </x-exclusive-details>
</div>
