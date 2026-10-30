@props(['disabled' => false])

<div class="relative">
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 sm:text-sm rounded-md h-[41.6px]']) !!}>
        {{ $slot }}
    </select>
</div>
