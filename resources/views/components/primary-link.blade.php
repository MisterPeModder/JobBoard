@props([])

<a
    {{ $attributes->merge(['class' => 'bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold']) }}>
    {{ $slot }}
</a>
