@props([])

@pushonce('components/exclusive-details')
    @vite(['resources/js/components/exclusiveDetails.ts'])
@endpushonce

<details {{ $attributes->merge(['class' => 'exclusive']) }}>
    {{ $slot }}
</details>
