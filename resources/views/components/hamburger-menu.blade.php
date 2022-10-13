@props([])

@pushonce('components/hamburger-menu')
    @vite(['resources/js/components/hamburgerMenu.ts'])
@endpushonce

<div id="hamburger-background" class="hidden fixed top-0 left-0 w-[100vw] h-[100vh] hamburger-toggle z-40 bg-black/10">
</div>
<nav id="hamburger-menu"
    class="fixed top-0 right-0 translate-x-full h-[100vh] w-[70vw] md:w-[33vw] lg:w-[15vw] z-50 backdrop-blur-md py-2 px-4 border-l border-l-brd/10 transition-transform ease-in-out duration-150">
    <span class="flex flex-row gap-2 text-xl font-semibold justify-between border-b-2 border-l-brd/10">
        Menu
        <x-hamburger-toggle-button />
    </span>

    <div {{ $attributes->merge() }}>
        {{ $slot }}
    </div>
</nav>
