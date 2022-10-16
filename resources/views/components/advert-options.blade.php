{{-- Advert options menu, requires JS --}}

@props([])

@pushonce('components/advert-options')
    @vite(['resources/js/components/advertOptions.ts'])
@endpushonce

@php
$itemClassBase = 'hover:bg-l-bgr-content w-full text-sm';
$itemClass = "$itemClassBase flex flex-row p-2 items-end gap-2";
@endphp

<div id="advert-options-dropdown"
    class="hidden absolute z-10 mt-2 right-2 origin-top-right rounded-md bg-l-bgr-main shadow-lg ring-1 ring-l-brd/10 ring-opacity-5 focus:outline-none animate-dropdown-open animate-dropdown-close"
    role="menu" aria-orientation="vertical" tabindex="-1">
    <div class="py-1" role="none">

        {{-- Favorite Ad Button --}}
        {{-- <a href="?favorite" class="{{ $itemClass }}" role="menuitem" tabindex="-1" id="advert-options-favorite">
            @svg('resources/images/star.svg', 'fill-gray-500')
            @tr('advert.favorite')
        </a> --}}

        {{-- Hide Ad Button --}}
        {{-- <a href="?not-interested" class="{{ $itemClass }}" role="menuitem" tabindex="-1" id="advert-options-hide">
            @svg('resources/images/delete.svg', 'fill-gray-500')
            @tr('advert.hide')
        </a> --}}

        {{-- Report Ad Button --}}
        {{-- <a href="?report" class="{{ $itemClass }}" role="menuitem" tabindex="-1" id="advert-options-report">
            @svg('resources/images/flag.svg', 'fill-gray-500')
            @tr('advert.report')
        </a> --}}

        {{-- # PRIVILEDGED ACTIONS # --}}
        {{-- the actions below require specific permissions for each advert, --}}
        {{-- so we need to show/hide these as case-by-case basis on the client-side using JS. --}}

        {{-- Edit Ad Button --}}
        <a href="{{ route('jobs.edit', '0') }}" class="{{ $itemClass }}" role="menuitem" tabindex="-1"
            id="advert-options-edit">
            @svg('resources/images/pen.svg', 'fill-gray-500')
            @tr('advert.edit')
        </a>

        {{-- Delete Ad Button --}}
        <form method="POST" action="{{ route('jobs.destroy', '0') }}" class="{{ $itemClassBase }}"
            id="advert-options-delete">
            @method('DELETE')
            @csrf

            <button role="menuitem" tabindex="-1" class="text-sm text-red-500 w-full flex flex-row gap-2 p-2">
                @svg('resources/images/delete.svg', 'fill-red-500')
                @tr('advert.delete')
            </button>
        </form>
    </div>
</div>
