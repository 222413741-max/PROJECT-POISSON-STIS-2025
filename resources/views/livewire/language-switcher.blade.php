<div class="flex justify-start z-10">
  <div class="relative flex items-center justify-between bg-white cursor-pointer py-1 px-2 rounded gap-2"
    wire:click="toggleDropdown">
    <x-icons.country-flag country="{{ $language }}" />
    <div class="flex gap-2 items-center w-full>
      <span class="w-full">{{ strtoupper($language) }}</span>
      <x-icons.chevron-down class="w-4" />
    </div>

    @if ($dropdownVisible)
      <div class="absolute bg-white top-[45px] left-0 cursor-pointer w-full rounded-[5px]">
        <div class="flex items-center hover:bg-gray-300 gap-2 py-2 px-4 rounded-[5px] w-full"
          wire:click="setLanguage('en')">
          <x-icons.country-flag country="en" />
          <span class="w-full">EN</span>
        </div>
        <div class="flex items-center hover:bg-gray-300 gap-2 py-2 px-4 rounded-[5px] w-full"
          wire:click="setLanguage('id')">
          <x-icons.country-flag country="id" />
          <span class="w-full">ID</span>
        </div>
      </div>
    @endif
  </div>
</div>
