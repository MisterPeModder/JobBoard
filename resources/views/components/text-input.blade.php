@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'rounded-md shadow-sm border-gray-300 focus:border-highlight focus:ring focus:ring-highlight-light focus:ring-opacity-50',
]) !!}>
