<div>
    <x-secondary-button wire:click="toggleModal()">
        {{ $buttonText }}
    </x-secondary-button>
    @if ($isOpen)
        <div class="fixed inset-0 z-30 flex bg-black bg-opacity-50 items-center justify-center" x-cloak>
            <div class="px-4 py-4 bg-primaryPoi25 rounded-sm shadow-sm m-4" role="dialog">
                <div class="my-2 relative">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg font-semibold text-gray-700 capitalize leading-3 dark:text-gray-300">
                            {{ $title }}</p>
                        <button
                            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                            aria-label="close" wire:click="toggleModal()">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                                aria-hidden="true">
                                <path
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" fill-rule="evenodd">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-center">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
