<div x-data="{ isModalOpen: @entangle('isModalOpen') }">
    <x-button wire:click="openModal">{{ __('dashboard.Tambah Pengumuman') }}</x-button>

    <form wire:submit.prevent="storeSoal" x-show="isModalOpen"
        class="fixed inset-0 z-30 flex bg-black bg-opacity-50 items-center justify-center" x-cloak>
        <!-- Modal -->
        <div x-show="isModalOpen" class="w-full px-6 py-4 bg-primaryPoi25 rounded-md shadow-md m-4 max-w-xl"
            role="dialog">
            <div class="my-2 relative">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold text-gray-700 capitalize leading-3 dark:text-gray-300">
                        {{ __('dashboard.Tambah Pengumuman Baru') }}</p>
                    <button type="button"
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                        aria-label="close" wire:click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-700">
                    <!-- Name -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="name">{{ __('dashboard.Judul') }}</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"
                                    autocomplete="name" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="name" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="name">{{ __('dashboard.Deskripsi') }}</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-textarea wire:model.defer="description" rows="10" id="description"></x-textarea>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="description" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- link -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="link">{{ __('dashboard.tautan') }}</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="link" type="text" class="mt-1 block w-full" wire:model.defer="link"
                                    autocomplete="link" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="link" class="mt-2" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <footer class="flex flex-col items-center justify-end pt-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                <x-button wire:loading.attr="disabled">
                    {{ __('dashboard.Tambah Pengumuman') }}
                </x-button>
            </footer>
        </div>
    </form>
</div>
