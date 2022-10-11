<x-main-layout>
    <div class="shadow-xl">
        <div class="flex flex-row flex-wrap gap-2 w-11/12 mx-auto py-2 mt-2">
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/search.svg') }}" alt="menu" class="">
                </div>
                <input type="text" aria-label="search job type"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                    placeholder="What position are you looking for?"></input>
            </div>
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/location.svg') }}" alt="menu" class="">
                </div>
                <input type="text" aria-label="search job location"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                    placeholder="Location"></input>
            </div>
            <a href="#"
                class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                Find Jobs
            </a>
            <a href="#"
                class="border-2 border-highlight hover:border-highlight-light transition ease-in-out duration-150 text-highlight hover:text-highlight-light rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                Filters
            </a>
        </div>
    </div>
    <main class="container mx-auto py-2 divide-y divide-l-brd/10 flex flex-col gap-2">
        <section id="adverts" class="flex flex-row flex-wrap gap-2 px-2">
            @foreach ($adverts as $advert)
                <x-job-advert :advert=$advert />
            @endforeach
        </section>
        <x-page-navigation :paginator="$adverts" width="5" />
    </main>

    <x-advert-options />
</x-main-layout>
