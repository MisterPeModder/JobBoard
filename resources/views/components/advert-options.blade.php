{{-- Advert options menu, requires JS --}}

@props([])

@pushonce('scripts')
    @vite(['resources/js/components/advertOptions.ts'])
@endpushonce

<div id="advert-options-dropdown"
    class="hidden absolute z-10 mt-2 right-2 origin-top-right rounded-md bg-l-bgr-main shadow-lg ring-1 ring-l-brd/10 ring-opacity-5 focus:outline-none animate-dropdown-open animate-dropdown-close"
    role="menu" aria-orientation="vertical" tabindex="-1">
    <div class="py-1" role="none">
        <span class="flex flex-row hover:bg-l-bgr-content p-2 items-end gap-2">
            @svg('resources/images/star.svg', 'fill-gray-500')
            <a href="?favorite" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                @tr('advert.favorite')
            </a>
        </span>
        <span class="flex flex-row hover:bg-l-bgr-content p-2 items-end gap-2">
            @svg('resources/images/delete.svg', 'fill-gray-500')
            <a href="?not-interested" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-1">
                @tr('advert.hide')
            </a>
        </span>
        <span class="flex flex-row hover:bg-l-bgr-content p-2 items-end gap-2">
            @svg('resources/images/flag.svg', 'fill-gray-500')
            <a href="?report" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-2">
                @tr('advert.report')
            </a>
        </span>
    </div>
</div>
