@props(['admin' => false])

@php
$baseClass = 'transition ease-in-out duration-150 text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold';
@endphp

<a
    {{ $attributes->merge()->class(["$baseClass bg-admin hover:bg-admin-light" => $admin, "$baseClass bg-highlight hover:bg-highlight-light" => !$admin]) }}>
    {{ $slot }}
</a>
