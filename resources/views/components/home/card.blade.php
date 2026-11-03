<div class="flex items-center p-4 bg-primaryPoi25 rounded-lg shadow-xs border dark:border-dark">
    <div {{ $attributes->merge(['class' => 'p-3 mr-4 rounded-full']) }}>
        {{ $slot }}
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-700">
            {{ __('dashboard.' . $title) }}
        </p>
        <p class="text-lg font-semibold text-gray-700">
            {{ $amount }}
        </p>
    </div>
</div>
