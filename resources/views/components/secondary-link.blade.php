@props(['admin' => false])

@php
$baseClass = 'border-2 transition ease-in-out duration-150 rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold';
@endphp

<a
    {{ $attributes->merge()->class(["$baseClass border-admin hover:border-admin-light text-admin hover:text-admin-light" => $admin, "$baseClass border-highlight hover:border-highlight-light text-highlight hover:text-highlight-light" => !$admin]) }}>
    {{ $slot }}
</a>
