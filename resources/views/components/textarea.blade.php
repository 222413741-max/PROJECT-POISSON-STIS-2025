@props(['disabled' => false])

@php
$class = $disabled ? 'bg-gray-200 ' : '';
@endphp

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $class . 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full']) !!}>{{ $slot }}</textarea>
