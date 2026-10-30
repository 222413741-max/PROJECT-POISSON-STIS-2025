<div x-data="{ isModalOpen: @entangle('isModalOpen') }">
    <x-button wire:click="openModal">Ubah Tanggal</x-button>

    <form wire:submit.prevent="updateTanggal()" x-show="isModalOpen"
        class="fixed inset-0 z-30 flex bg-black bg-opacity-50 items-center justify-center" x-cloak>
        <!-- Modal -->
        <div x-show="isModalOpen" class="w-full px-6 py-4 bg-primaryPoi25 rounded-md shadow-md m-4 max-w-xl"
            role="dialog">
            <div class="my-2 relative">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold text-gray-800 capitalize leading-3 dark:text-gray-300">Ubah Waktu
                        Kegiatan</p>
                    <button type="button"
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-800"
                        aria-label="close" wire:click="closeModal(), data : {id: '', kegiatan: ''}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-800">
                    <!-- Type -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="kegiatan">Kegiatan</label>
                            </div>
                            <div class="md:w-2/3">
                                <select id="kegiatan"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    wire:model.defer="kegiatan">
                                    <option value="">Pilih kegiatan</option>
                                    <option value="Pembukaan Pendaftaran Lomba Infografis">Pembukaan Pendaftaran Lomba
                                        Infografis</option>
                                    <option value="Penutupan Pendaftaran Lomba Infografis">Penutupan Pendaftaran Lomba
                                        Infografis</option>
                                    <option value="Pembukaan Pendaftaran Lomba Olimpiade">Pembukaan Pendaftaran Lomba
                                        Olimpiade</option>
                                    <option value="Penutupan Pendaftaran Lomba Olimpiade">Penutupan Pendaftaran Lomba
                                        Olimpiade</option>
                                    <option value="Pembukaan Pendaftaran Lomba OSC">Pembukaan Pendaftaran Lomba OSC
                                    </option>
                                    <option value="Penutupan Pendaftaran Lomba OSC">Penutupan Pendaftaran Lomba OSC
                                    </option>
                                    <option value="Penyisihan Infografis Mulai">Penyisihan Infografis Mulai</option>
                                    <option value="Penyisihan Infografis Berakhir">Penyisihan Infografis Berakhir
                                    </option>
                                    <option value="Final Infografis Mulai">Final Infografis Mulai</option>
                                    <option value="Final Infografis Berakhir">Final Infografis Berakhir</option>
                                    <option value="Penyisihan Olimpiade Mulai">Penyisihan Olimpiade Mulai</option>
                                    <option value="Penyisihan Olimpiade Berakhir">Penyisihan Olimpiade Berakhir</option>
                                    <option value="Semifinal Olimpiade Mulai">Semifinal Olimpiade Mulai</option>
                                    <option value="Semifinal Olimpiade Berakhir">Semifinal Olimpiade Berakhir</option>
                                    <option value="Final Olimpiade Mulai">Final Olimpiade Mulai</option>
                                    <option value="Final Olimpiade Berakhir">Final Olimpiade Berakhir</option>
                                    <option value="Penyisihan OSC Mulai">Penyisihan OSC Mulai</option>
                                    <option value="Penyisihan OSC Berakhir">Penyisihan OSC Berakhir</option>
                                    <option value="Semifinal OSC Mulai">Semifinal OSC Mulai</option>
                                    <option value="Semifinal OSC Berakhir">Semifinal OSC Berakhir</option>
                                    <option value="Final OSC Mulai">Final OSC Mulai</option>
                                    <option value="Final OSC Berakhir">Final OSC Berakhir</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="kegiatan" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Time -->
                    <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block text-gray-800 font-bold mb-1 md:mb-0 pr-4"
                                    for="time">Waktu</label>
                            </div>
                            <div class="md:w-2/3">
                                <x-input id="time" class="mt-1 block w-full" type="datetime-local"
                                    wire:model.defer="time" />
                            </div>
                        </div>
                        <div class="md:flex md:justify-end">
                            <div class="md:w-2/3">
                                <x-input-error for="description" class="mt-2" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <footer class="flex flex-col items-center justify-end pt-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                <x-button wire:loading.attr="disabled">Ubah Waktu</x-button>
            </footer>
        </div>
    </form>
</div>
