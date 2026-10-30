@props(['color' => 'bg-secondaryPoi24-700'])

<a {{ $attributes->merge(['class' => "inline-flex items-center justify-center px-4 py-2 $color border border-transparent rounded-md font-semibold text-white"]) }}>
    {{ $slot }}
</a>
