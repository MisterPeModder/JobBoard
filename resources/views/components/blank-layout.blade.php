{{-- Empty layout for the auth pages --}}

@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The next-gen job search platform">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'JobBoard') }}</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite(['resources/js/common.ts', 'resources/css/common.css'])

    @stack('components/advert-options')
    @stack('components/exclusive-details')
    @stack('components/hamburger-menu')
    @stack('components/image-input')
</head>

<body class="font-sans antialiased bg-l-bgr-main text-gray-700">
    {{-- Page content goes here --}}
    {{ $slot }}
    <footer class="text-sm container mx-auto py-2 border-t border-l-brd/10 text-center">
        Made with ❤️ by Yanis Guaye and Melvin Courjaud
    </footer>
</body>

</html>
