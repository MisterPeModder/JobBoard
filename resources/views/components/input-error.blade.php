@props(['field'])

@php
$messages = $errors->get($field);
@endphp

@if ($messages)
    <ul class="text-sm text-red-600 space-y-1">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
