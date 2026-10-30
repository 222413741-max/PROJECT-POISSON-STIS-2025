{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-primaryPoisson-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-200 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-primaryPoisson-600 focus:bg-gray-700 dark:focus:bg-primaryPoisson-600 active:bg-gray-900 dark:active:bg-primaryPoisson-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}
@props(['color' => 'bg-secondaryPoi24-700'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-white $color"]) }}>
    {{ $slot }}
</button>
