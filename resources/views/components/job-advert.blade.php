<div
    class="relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 border-l-brd/10 hover:border-l-bgr-highlight flex flex-col">
    <span class="font-semibold hover:underline flex flex-row justify-between">
        {{ $title }}
        <img src="{{ Vite::asset('resources/images/three-dots.svg') }}" alt="advert options">
    </span>

    <div class="hover:no-underline">{{ $company }}</div>
    <div class="">{{ $location }}</div>
    <ol class="list-disc list-inside border-y border-solid border-l-brd/10 my-2 py-2">
        {{ $shortDescription }}
    </ol>
    <div class="collapsible collapsible-closed">
        <div class="collapsible-content text-sm border-b border-solid border-l-brd/10 mb-2 pb-2">{{ $fullDescription }}
        </div>
        <div class="collapsible-open cursor-pointer text-l-bgr-highlight">
            Learn more
            <span class="text-xl">
                <span class="lg:hidden">&blacktriangledown;</span>
                <span class="hidden lg:inline">&blacktriangleright;</span>
            </span>
        </div>
        <div class="collapsible-close hidden cursor-pointer text-l-bgr-highlight">
            Collapse
            <span class="text-xl">
                <span class="lg:hidden">&blacktriangle;</span>
                <span class="hidden lg:inline">&blacktriangleleft;</span>
            </span>
        </div>
    </div>
</div>
