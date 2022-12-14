<x-main-layout>
    <div class="shadow-xl">
        <form method="GET" class="flex flex-row flex-wrap gap-2 w-11/12 mx-auto py-2 mt-2">
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/search.svg') }}" alt="menu" class="">
                </div>
                <input name="query" id="query" type="text" aria-label="search job type"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                    placeholder="{{ __('search.field.job_type') }}" value="{{ $filters['query'] ?? '' }}"></input>
            </div>
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/location.svg') }}" alt="menu" class="">
                </div>
                <input name="location" id="location" type="text" aria-label="search job location"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                    placeholder="{{ __('search.field.location') }}" value="{{ $filters['location'] ?? '' }}"></input>
            </div>

            {{-- Hidden company filter, set when pressing the 'show adverts' button on a company's page --}}
            <input name="company" id="company" type="hidden"
                value="{{ isset($filters['company']) ? $filters['company']->id : '' }}"></input>

            <x-primary-button>
                @tr('search.perform')
            </x-primary-button>

            {{-- Filters --}}
            @if (!empty($filters))
                <span
                    class="border-2 border-highlight text-highlight rounded-xl p-1.5 text-sm flex flex-row flex-wrap gap-1 items-center font-semibold divide-highlight">
                    <p class="shrink-0 border-r border-highlight pr-1">@tr('search.filters')</p>

                    @foreach ($filters as $name => $value)
                        <a href="{{ $request->fullUrlWithoutQuery($name) }}"
                            class="hover:text-highlight-light transition ease-in-out duration-150 pl-1 shrink-0 underline hover:italic font-normal"
                            title="{{ __('search.filters.remove') }}">

                            {{-- filter is either a model instance or a string --}}
                            {{ __('search.filters.' . $name, [$name => $value instanceof \Illuminate\Database\Eloquent\Model ? $value->name : $value]) }}
                        </a>
                    @endforeach
                </span>
            @endif
        </form>
    </div>
    <main class="container mx-auto py-2 divide-y divide-l-brd/10 flex flex-col gap-2">
        <section id="adverts" class="flex flex-row flex-wrap gap-2 px-2">
            @foreach ($adverts as $advert)
                <x-job-advert :advert=$advert />
            @endforeach

            @if (count($adverts) == 0)
                <em class="text-gray-400 w-full text-center py-8">@tr('list.empty')</em>
            @endif
        </section>
        <x-page-navigation :paginator="$adverts" width="5" />
    </main>

    <x-advert-options />
</x-main-layout>
