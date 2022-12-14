<x-blank-layout>
    <main class="w-full md:w-2/3 lg:w-1/3 mx-auto">
        <div class="m-4 p-2 bg-l-bgr-content border border-l-brd/10 rounded-xl flex flex-col items-center">
            <a id="logo" href="/" class="mb-4 pb-4 border-b-2 border-l-brd/10">
                @svg('resources/images/logo.svg', 'h-10 w-60')
            </a>

            <span class="flex flex-row flex-wrap gap-4 items-center justify-around">
                @can('administrate')
                    <a href="{{ route('admin.index') }}" class="underline font-semibold text-admin">
                        @tr('admin.index.title')
                    </a>
                @endcan
                <a href="{{ route('companies.index') }}" class="underline font-semibold">
                    @tr('company.list.title')
                </a>
                @guest
                    {{-- "Sign In" widget, will only display when not logged --}}
                    <a href="{{ route('register') }}" class="underline font-semibold">@tr('sign_in')</a>
                    <a href="{{ route('login') }}" class="underline font-semibold">@tr('log_in')</a>
                @endguest
                @auth
                    {{-- "My profile" widget, will only display when logged --}}
                    <a href="{{ route('users.show', Auth::user()) }}" class="lb:block underline font-semibold">
                        @tr('profile')</a>
                @endauth
                @auth
                    {{-- "Log out" widget, will only display when logged --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="lb:block underline font-semibold">
                            @tr('log_out')</button>
                    </form>
                @endauth
            </span>

            <form method="GET" action="{{ route('jobs.index') }}"
                class="flex flex-row flex-wrap gap-2 w-11/12 mx-auto py-2 mt-2">
                <div class="relative rounded-full shadow-sm w-full border border-inherit bg-l-bgr-main">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                        <img src="{{ Vite::asset('resources/images/search.svg') }}" alt="menu" class="">
                    </div>
                    <input name="query" id="query" type="text" aria-label="search job type"
                        class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                        placeholder="{{ __('search.field.job_type') }}"></input>
                </div>
                <div class="relative rounded-full shadow-sm w-full border border-inherit bg-l-bgr-main">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                        <img src="{{ Vite::asset('resources/images/location.svg') }}" alt="menu" class="">
                    </div>
                    <input name="location" id="location" type="text" aria-label="search job location"
                        class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                        placeholder="{{ __('search.field.location') }}"></input>
                </div>

                <x-primary-button>
                    @tr('search.perform')
                </x-primary-button>
            </form>
        </div>
    </main>
</x-blank-layout>
