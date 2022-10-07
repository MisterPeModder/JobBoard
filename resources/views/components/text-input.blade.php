@props(['disabled' => false, 'readonly' => false])

<input {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge([
    'class' =>
        'rounded-md shadow-sm border-gray-300 focus:border-highlight focus:ring focus:ring-highlight-light focus:ring-opacity-50 read-only:opacity-50 disabled:opacity-50',
]) !!}>
