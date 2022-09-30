{{-- Main layout of the JobBoard pages --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The next-gen job search platform">

    <title>{{ $title ?? 'Job Board' }}</title>

    @vite(['resources/js/app.ts', 'resources/css/app.css'])
</head>

<body class="antialiased bg-l-bgr-main">
    <header class="flex flex-col backdrop-blur-md sticky top-0 border-b border-l-brd/10 z-20">
        <span class="flex flex-row  justify-between items-center p-2">
            <span class="flex flex-row items-center gap-2">
                <span class="logo-dot"></span>
                <a id="logo" href="/" class="text-2xl font-bold">JobBoard</a>
            </span>
            <span class="flex flex-row gap-2">
                @guest
                    {{-- "Sign In" widget, will only display when not logged --}}
                    <a href="#"
                        class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                        Sign in</a>
                @endguest
                <img src="{{ Vite::asset('resources/images/hamburger.svg') }}" alt="menu">
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
