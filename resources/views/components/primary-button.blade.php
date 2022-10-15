@props(['disabled' => false, 'admin' => false])

@php
$baseClass = 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150';
@endphp

<button
    {{ $attributes->merge()->class(["$baseClass bg-admin hover:bg-admin-light" => $admin, "$baseClass bg-highlight hover:bg-highlight-light" => !$admin]) }}>
    {{ $slot }}
</button>
