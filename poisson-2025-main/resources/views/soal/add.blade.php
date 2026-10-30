<div x-data="{ isModalOpen: @entangle('isModalOpen') }">
    <x-button wire:click="openModal">Tambah soal baru</x-button>

    <form wire:submit.prevent="storeSoal" x-show="isModalOpen"
        class="fixed inset-0 z-30 flex bg-black bg-opacity-50 items-center justify-center" x-cloak>
        <!-- Modal -->
        <div x-show="isModalOpen" class="w-full px-6 py-4 bg-primaryPoi25 rounded-md shadow-md m-4 max-w-xl"
            role="dialog">
            <div class="my-2 relative">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold text-gray-800 capitalize leading-3 dark:text-gray-300">Tambah soal
                        baru</p>
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
                    <!-- Name -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="name">Nama</label>
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

                    <!-- Code -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="code">Kode</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="code" type="text" class="mt-1 block w-full"
                                    wire:model.defer="code" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="code" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="password">Kata
                                    Sandi</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="password" type="text" class="mt-1 block w-full"
                                    wire:model.defer="password" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="password" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="type">Tipe</label>
                            </div>
                            <div class="md:w-2/3">
                                <select id="type"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    wire:model.defer="type">
                                    <option value="">Pilih tipe soal</option>
                                    <option value="penyisihan">Penyisihan</option>
                                    <option value="semifinal">Semifinal</option>
                                    <option value="final">Final</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="type" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Soal -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="type">Soal</label>
                            </div>
                            <div class="md:w-2/3" x-data="{ 'pdf': @entangle('soal_name') }">
                                <input type="file" id="pdf" class="hidden" x-ref="pdf"
                                    wire:model.defer="soal" x-on:change="pdf = $refs.pdf.files[0].name;" />
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
                                <x-input-error for="soal" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer
                class="flex flex-col items-center justify-end pt-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                <x-button wire:loading.attr="disabled"> Tambah soal baru </x-button>
            </footer>
        </div>
    </form>
</div>
