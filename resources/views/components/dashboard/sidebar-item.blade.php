@props(['title' => 'dashboard', 'menu' => 'Menu Item'])

@if ($menu == $title)
    <li class="relative px-6 py-3 hover:bg-primaryPoi25-200 bg-primaryPoi25">
        <span class="absolute inset-y-0 left-0 w-1 bg-primaryPoi25-900 rounded-tr-lg rounded-br-lg"></span>
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 text-gray-800"
            {{ $attributes->merge(['href']) }}>
            {{ $icon }}
            {{-- <span class="ml-4 capitalize">{{ __('dashboard.' . $menu) }}</span> --}}
            <span class="ml-4 capitalize">{{ __($menu) }}</span>
        </a>
    </li>
@else
    <li class="relative px-6 py-3 hover:bg-primaryPoi25-100">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 text-gray-600"
            {{ $attributes->merge(['href']) }}>
            {{ $icon }}
            {{-- <span class="ml-4 capitalize">{{ __('dashboard.' . $menu) }}</span> --}}
            <span class="ml-4 capitalize">{{ __($menu) }}</span>
        </a>
    </li>
@endif
