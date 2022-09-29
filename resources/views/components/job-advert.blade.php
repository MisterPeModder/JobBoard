{{-- A job advert component with a collapsible description --}}

<div
    class="relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-l-bgr-highlight flex flex-col">
    <span class="font-semibold hover:underline flex flex-row justify-between">
        {{ $title }}
        <img src="{{ Vite::asset('resources/images/three-dots.svg') }}" alt="advert options">
    </span>

    <div class="hover:no-underline">{{ $company }}</div>
    <div class="">{{ $location }}</div>
    <ol class="list-disc list-inside border-y border-solid border-l-brd/10 my-2 py-2">
        {{ $shortDescription }}
    </ol>
    <div class="collapsible">
        <div class="collapsible-content hidden text-sm border-b border-solid border-l-brd/10 mb-2 pb-2">
            {{ $fullDescription }}
        </div>
        <div class="collapsible-button cursor-pointer text-l-bgr-highlight hover:underline">
            Learn more
            <span class="text-xl">
                <span class="lg:hidden">&blacktriangledown;</span>
                <span class="hidden lg:inline">&blacktriangleright;</span>
            </span>
        </div>
        <div class="collapsible-button hidden cursor-pointer text-l-bgr-highlight hover:underline">
            Collapse
            <span class="text-xl">
                <span class="lg:hidden">&blacktriangle;</span>
                <span class="hidden lg:inline">&blacktriangleleft;</span>
            </span>
        </div>
    </div>
</div>
