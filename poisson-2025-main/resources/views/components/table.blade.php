<div>
  <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap my-4">
        <thead>
          <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            @foreach ($theads as $thead)
              <th class="px-4 py-3 lg:whitespace-nowrap">{{ __('dashboard.' . $thead) }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          {{ $slot }}
        </tbody>
      </table>
    </div>
  </div>
</div>
