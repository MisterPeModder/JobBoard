{{-- Main layout of the OneBoard pages --}}

@props(['title' => null, 'showprofile' => true, 'companies_link' => true, 'admin_link' => true])

@php
$user = Illuminate\Support\Facades\Auth::user();
@endphp

<x-blank-layout :title=$title>
    <header class="flex flex-col backdrop-blur-md sticky top-0 border-b border-l-brd/10 z-20 px-2">
        <span class="flex flex-row  justify-between items-center p-2">
            <a id="logo" href="/">
                @svg('resources/images/logo.svg')
            </a>
            <nav class="flex flex-row items-center lg:divide-x-2 divide-l-brd/10">
                @if ($admin_link && $user?->can('administrate'))
                    <a href="{{ route('admin.index') }}" class="hidden lg:block font-semibold text-admin">
                        @tr('admin.index.title')
                    </a>
                @endif

                @if (session()->get('locale') == 'en')
                    <a href="{{ route('setlocalization', 'fr') }}" class="hidden lg:block font-semibold pl-1 ml-1">
                        Français
                    </a>
                @else
                    <a href="{{ route('setlocalization', 'en') }}" class="hidden lg:block font-semibold pl-1 ml-1">
                        English
                    </a>
                @endif

                @if ($companies_link)
                    @if (isset($user?->company) && $user?->can('update', $user->company))
                        <a href="{{ route('companies.edit', $user->company) }}"
                            class="hidden lg:block font-semibold pl-1 ml-1">
                            @tr('company.edit.title')
                        </a>
                    @endif
                    <a href="{{ route('companies.index') }}" class="hidden lg:block font-semibold pl-1 ml-1">
                        @tr('company.list.title')
                    </a>
                @endif

                @guest
                    {{-- "Sign In" widget, will only display when not logged --}}
                    <a href="{{ route('register') }}"
                        class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold pl-1 ml-1">
                        @tr('sign_in')</a>
                    <span class="pl-1 ml-1">
                        <a href="{{ route('login') }}"
                            class="border-2 border-highlight hover:border-highlight-light transition ease-in-out duration-150 text-highlight hover:text-highlight-light rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                            @tr('log_in')</a>
                    </span>
                @endguest
                @auth
                    @if ($showprofile)
                        {{-- "My profile" widget, will only display when logged --}}
                        <a href="{{ route('users.show', Auth::user()) }}" class="hidden lg:block font-semibold pl-1 ml-1">
                            @tr('profile')</a>
                    @endif

                    {{-- "Log out" widget, will only display when logged --}}
                    <form method="POST" action="{{ route('logout') }}" class="hidden lg:block font-semibold pl-1 ml-1">
                        @csrf
                        <button type="submit">
                            @tr('log_out')</button>
                    </form>
                @endauth

                <x-hamburger-toggle-button class="lg:hidden pl-1 ml-1" />
            </nav>
        </span>
    </header>

    <x-hamburger-menu class="mt-2 flex flex-col gap-1 items-start px-4">
        @if (session()->get('locale') == 'en')
            <a href="{{ route('setlocalization', 'fr') }}" class="font-semibold border-b border-l-brd/10 py-1 w-full">
                Français
            </a>
        @else
            <a href="{{ route('setlocalization', 'en') }}" class="font-semibold border-b border-l-brd/10 py-1 w-full">
                English
            </a>
        @endif

        @guest
            {{-- "Sign In" widget, will only display when not logged --}}
            <a href="{{ route('register') }}" class="font-semibold text-highlight border-b border-l-brd/10 py-1 w-full">
                @tr('sign_in')</a>
            <a href="{{ route('login') }}" class="font-semibold text-highlight-light border-b border-l-brd/10 py-1 w-full">
                @tr('log_in')</a>
        @endguest

        @auth
            @if ($showprofile)
                {{-- "My profile" widget, will only display when logged --}}
                <a href="{{ route('users.show', Auth::user()) }}"
                    class="font-semibold border-b border-l-brd/10 py-1 w-full">@tr('profile')</a>
            @endif

            {{-- "Log out" widget, will only display when logged --}}
            <form method="POST" action="{{ route('logout') }}" class="font-semibold border-b border-l-brd/10 py-1 w-full">
                @csrf
                <button type="submit">@tr('log_out')</button>
            </form>
        @endauth

        @if ($admin_link && $user?->can('administrate'))
            <a href="{{ route('admin.index') }}" class="font-semibold text-admin border-b border-l-brd/10 py-1 w-full">
                @tr('admin.index.title')
            </a>
        @endif

        @if ($companies_link)
            @if (isset($user?->company) && $user?->can('update', $user->company))
                <a href="{{ route('companies.edit', $user->company) }}"
                    class="font-semibold border-b border-l-brd/10 py-1 w-full">
                    @tr('company.edit.title')
                </a>
            @endif
            <a href="{{ route('companies.index') }}" class="font-semibold">
                @tr('company.list.title')
            </a>
        @endif

    </x-hamburger-menu>

    {{-- Page content goes here --}}
    {{ $slot }}

</x-blank-layout>
