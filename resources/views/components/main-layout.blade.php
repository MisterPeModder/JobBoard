{{-- Main layout of the JobBoard pages --}}

@props(['title' => null, 'script' => null, 'companies_link' => true])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The next-gen job search platform">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title === null ? '' : "$title - ") . config('app.name', 'JobBoard') }}</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite(['resources/js/common.ts', 'resources/css/common.css'])

    @isset($script)
        @vite([$script])
    @endisset
    @stack('scripts')
</head>

<body class="font-sans antialiased bg-l-bgr-main text-gray-700">
    <header class="flex flex-col backdrop-blur-md sticky top-0 border-b border-l-brd/10 z-20 px-2">
        <span class="flex flex-row  justify-between items-center p-2">
            <span class="flex flex-row items-center gap-2">
                <span class="logo-dot"></span>
                <a id="logo" href="/" class="text-2xl font-bold">JobBoard</a>
            </span>
            <span class="flex flex-row gap-2 items-center">
                @if ($companies_link)
                    <a href="{{ route('companies.index') }}" class="hidden lg:block underline font-semibold">
                        @tr('company.list.title')
                    </a>
                @endif
                @guest
                    {{-- "Sign In" widget, will only display when not logged --}}
                    <a href="{{ route('register') }}"
                        class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                        Sign in</a>
                @endguest
                <img src="{{ Vite::asset('resources/images/hamburger.svg') }}" alt="menu" class="lg:hidden">
            </span>
        </span>
    </header>
    {{-- Page content goes here --}}
    {{ $slot }}
    <footer class="text-sm container mx-auto py-2 border-t border-l-brd/10 text-center">
        Made with ❤️ by Yanis Guaye and Melvin Courjaud
    </footer>
</body>

</html>
