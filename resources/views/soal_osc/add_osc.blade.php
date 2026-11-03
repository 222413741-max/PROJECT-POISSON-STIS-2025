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
                    <!-- Question -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="question">Soal</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-textarea id="question" type="text" class="mt-1 block w-full"
                                    wire:model.defer="question" autocomplete="question" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="question" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Option A -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="option_a">Opsi
                                    A</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="option_a" type="text" class="mt-1 block w-full"
                                    wire:model.defer="option_a" autocomplete="option_a" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="option_a" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Option B -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="option_b">Opsi
                                    B</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="option_b" type="text" class="mt-1 block w-full"
                                    wire:model.defer="option_b" autocomplete="option_b" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="option_b" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Option C -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="option_c">Opsi
                                    C</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="option_c" type="text" class="mt-1 block w-full"
                                    wire:model.defer="option_c" autocomplete="option_c" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="option_c" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Option D -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="option_d">Opsi
                                    D</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="option_d" type="text" class="mt-1 block w-full"
                                    wire:model.defer="option_d" autocomplete="option_d" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="option_d" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Option E -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="option_e">Opsi
                                    E</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="option_e" type="text" class="mt-1 block w-full"
                                    wire:model.defer="option_e" autocomplete="option_e" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="option_e" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Option Key -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="option_key">Kunci
                                    Opsi</label>
                            </div>
                            <div class="md:w-2/3">
                                <select id="option_key"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    wire:model.defer="option_key">
                                    <option value="">Pilih opsi kunci</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="option_key" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Type -->
                    {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="type">Tipe</label>
                            </div>
                            <div class="md:w-2/3">
                                <select id="type"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    wire:model.defer="type">
                                    <option value="">Pilih tipe soal</option>
                                    <option value="penyisihan">Penyisihan</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="type" class="mt-2" />
                            </div>
                        </div>
                    </div> --}}
                    <!-- Alternatif Type -->
                    {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="type">Tipe</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="type" type="text" class="mt-1 block w-full" wire:model.defer="type"
                                    autocomplete="type" placeholder="penyisihan" disabled/>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="type" class="mt-2" />
                            </div>
                        </div>
                    </div> --}}

                    {{-- Rifqi : sesuaikan dengan poin benar, salah, dan kosong. Pada bagian input ini dihilangkan karna semua soal memiliki nilai yang sama  --}}
                    <!-- Poin Benar -->
                    {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="correct_point">Poin Benar</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="correct_point" type="number" class="mt-1 block w-full" wire:model.defer="correct_point"
                                    autocomplete="correct_point" min="0" max="100" placeholder="3" disabled/>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="correct_point" class="mt-2"/>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Poin Salah -->
                    {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="wrong_point">Poin Salah</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="wrong_point" type="number" class="mt-1 block w-full" wire:model.defer="wrong_point"
                                    autocomplete="wrong_point" placeholder="-1" disabled/>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="wrong_point" class="mt-2" />
                            </div>
                        </div>
                    </div> --}}

                    <!-- Poin Kosong-->
                    {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="blank_point">Poin Kosong</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="blank_point" type="number" class="mt-1 block w-full" wire:model.defer="blank_point"
                                    autocomplete="blank_point" placeholder="0" disabled/>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="blank_point" class="mt-2" />
                            </div>
                        </div>
                    </div> --}}

                    <!-- Paket Soal -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4" for="package">Paket
                                    Soal</label>
                            </div>
                            <div class="md:w-2/3">
                                <select id="package"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    wire:model.defer="package">
                                    <option value="">Pilih opsi paket</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="package" class="mt-2" />
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
