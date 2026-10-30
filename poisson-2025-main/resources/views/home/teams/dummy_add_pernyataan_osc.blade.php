<div x-data="{ isModalOpen: @entangle('isModalOpen') }">
    <x-button wire:click="openModal">Tambah surat pernyataan</x-button>

    {{-- Jadiin array soal dulu karena belum ngerti banget --}}
    <form wire:submit.prevent="storePernyataan" x-show="isModalOpen"
        class="fixed inset-0 z-30 flex bg-black bg-opacity-50 items-center justify-center" x-cloak>
        <!-- Modal -->
        <div x-show="isModalOpen" class="w-full px-6 py-4 bg-primaryPoi25 rounded-md shadow-md m-4 max-w-xl"
            role="dialog">
            <div class="my-2 relative">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold text-gray-800 capitalize leading-3 dark:text-gray-300">Tambah surat
                        pernyataan</p>
                    <button type="button"
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-800"
                        aria-label="close" wire:click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-800">
                    <!-- Surat -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="type">Surat
                                    Pernyataan</label>
                            </div>
                            {{-- Jadiin array soal dulu karena belum ngerti banget --}}
                            <div class="md:w-2/3" x-data="{ 'pdf': @entangle('pernyataan_name') }">
                                <input type="file" id="pdf" class="hidden" x-ref="pdf"
                                    wire:model.defer="pernyataan" x-on:change="pdf = $refs.pdf.files[0].name;" />
                                <div
                                    class="flex divide-x-1 border rounded-md shadow-sm border-gray-300 justify-between">
                                    <span class="text-gray-700 text-sm p-2 overflow-hidden whitespace-nowrap"
                                        x-text="pdf">
                                    </span>
                                    <x-secondary-button type="button"
                                        class="whitespace-nowrap dark:bg-primaryPoisson-800 dark:text-gray-300 dark:border-dark"
                                        x-on:click.prevent="$refs.pdf.click()">
                                        Pilih File PDF
                                    </x-secondary-button>
                                </div>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="pernyataan" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="flex flex-col items-center justify-end pt-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                <x-button wire:loading.attr="disabled"> Tambah surat </x-button>
            </footer>
        </div>
    </form>
</div>
