@props([])

<a
    {{ $attributes->merge(['class' => 'border-2 border-highlight hover:border-highlight-light transition ease-in-out duration-150 text-highlight hover:text-highlight-light rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold']) }}>
    {{ $slot }}
</a>
