<div>
    {{-- Information --}}
    <x-form-section submit="save">
        <x-slot name="title">
            {{ __('dashboard.Informasi Pendamping Final OSC') }}
        </x-slot>

        <x-slot name="description">
            {{ __('dashboard.Lengkapi data pendamping untuk Final Official Statistics Challenge') }}
        </x-slot>

        <x-slot name="form">
            <!-- Team Name (Read Only) -->
            <div class="col-span-6">
                <x-label for="team_name" value="{{ __('dashboard.Nama Tim') }}" />
                <x-input id="team_name" type="text" class="block w-full mt-1" value="{{ $team->name }}" disabled />
            </div>

            <!-- Nama Pendamping -->
            <div class="col-span-6">
                <x-label for="nama_pendamping" value="{{ __('dashboard.Nama Pendamping') }}" />
                <x-input id="nama_pendamping" type="text" class="block w-full mt-1" 
                         wire:model.defer="nama_pendamping" 
                         :disabled="$isDisabled || $data" />
                <x-input-error for="nama_pendamping" class="mt-2" />
            </div>

            <!-- Status Pendamping -->
            <div class="col-span-6">
                <x-label for="status_pendamping" value="{{ __('dashboard.Status Pendamping') }}" />
                <select id="status_pendamping" 
                        wire:model="status_pendamping"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        :disabled="$isDisabled || $data">
                    <option value="">{{ __('dashboard.Pilih Status Pendamping') }}</option>
                    <option value="Guru">{{ __('dashboard.Guru') }}</option>
                    <option value="Orang Tua Peserta">{{ __('dashboard.Orang Tua Peserta') }}</option>
                    <option value="Lainnya">{{ __('dashboard.Lainnya') }}</option>
                </select>
                <x-input-error for="status_pendamping" class="mt-2" />
                
                <!-- Input manual untuk status lainnya -->
                @if ($status_pendamping === 'Lainnya')
                    <div class="mt-2">
                        <x-input id="status_lainnya" type="text" class="block w-full mt-1" 
                                 wire:model.defer="status_lainnya" 
                                 placeholder="{{ __('dashboard.Sebutkan status pendamping') }}"
                                 :disabled="$isDisabled || $data" />
                        <x-input-error for="status_lainnya" class="mt-2" />
                    </div>
                @endif
            </div>

            <!-- Kontak WA -->
            <div class="col-span-6">
                <x-label for="kontak_wa_pendamping" value="{{ __('dashboard.Kontak WhatsApp') }}" />
                <x-input id="kontak_wa_pendamping" type="text" class="block w-full mt-1" 
                         wire:model.defer="kontak_wa_pendamping" 
                         placeholder="Contoh: 08123456789"
                         :disabled="$isDisabled || $data" />
                <x-input-error for="kontak_wa_pendamping" class="mt-2" />
            </div>

            <!-- Foto Pendamping -->
            <div class="col-span-6">
                <x-label for="foto_pendamping" value="{{ __('dashboard.Foto Pendamping') }}" />
                
                @if ($data && $foto_pendamping)
                    <div class="mt-2">
                        <img src="{{ $this->getFotoUrl() }}" alt="Foto Pendamping" class="w-32 h-32 object-cover rounded-lg border">
                        <p class="mt-2 text-sm text-gray-600">{{ __('dashboard.Foto pendamping sudah diunggah') }}</p>
                    </div>
                @else
                    <div class="mt-2">
                        <input type="file" id="foto_pendamping" 
                               wire:model="temp_foto" 
                               accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                               @if($isDisabled || $data) disabled @endif />
                        
                        @if ($temp_foto)
                            <div class="mt-2">
                                <img src="{{ $temp_foto->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-600">{{ __('dashboard.Preview foto yang akan diunggah') }}</p>
                            </div>
                        @endif
                        
                        <p class="mt-1 text-sm text-red-600">Max file size: 2MB (JPG, PNG)</p>
                    </div>
                @endif
                
                <x-input-error for="temp_foto" class="mt-2" />
            </div>

            <!-- Loading indicator for file upload -->
            <div wire:loading wire:target="temp_foto" class="col-span-6">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('dashboard.Sedang mengunggah foto...') }}
                </div>
            </div>
        </x-slot>

        @if (!$data && !$isDisabled)
            <x-slot name="actions">
                <x-loading />
                <x-button type="button" wire:click="confirmSave" wire:loading.attr="disabled" wire:target="confirmSave">
                    {{ __('dashboard.Simpan Data Pendamping') }}
                </x-button>
            </x-slot>
        @elseif ($isDisabled)
            <x-slot name="actions">
                <div class="text-red-600 text-sm">
                    {{ __('dashboard.Waktu pendaftaran pendamping telah berakhir') }}
                </div>
            </x-slot>
        @else
            <x-slot name="actions">
                <div class="text-green-600 text-sm">
                    {{ __('dashboard.Data pendamping sudah tersimpan oleh tim') }}
                </div>
            </x-slot>
        @endif
    </x-form-section>

    @if ($data)
        {{-- Display Saved Data --}}
        <div class="mt-8">
            <x-form-section>
                <x-slot name="title">
                    {{ __('dashboard.Data Pendamping Tersimpan') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('dashboard.Berikut adalah data pendamping yang telah disimpan') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-gray-700">Nama Pendamping:</h4>
                                <p class="text-gray-900">{{ $data->nama_pendamping }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-700">Status:</h4>
                                <p class="text-gray-900">{{ $data->status_pendamping }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-700">Kontak WhatsApp:</h4>
                                <p class="text-gray-900">{{ $data->kontak_wa_pendamping }}</p>
                            </div>
                            @if ($data->foto_pendamping)
                                <div>
                                    <h4 class="font-semibold text-gray-700">Foto Pendamping:</h4>
                                    <img src="{{ $this->getFotoUrl() }}" alt="Foto Pendamping" class="w-24 h-24 object-cover rounded-lg border mt-1">
                                </div>
                            @endif
                        </div>
                    </div>
                </x-slot>
            </x-form-section>
        </div>
    @endif

    <!-- Confirmation Modal -->
    <x-confirmation-modal wire:model="showConfirmModal">
        <x-slot name="title">
            {{ __('dashboard.Konfirmasi Penyimpanan Data') }}
        </x-slot>

        <x-slot name="content">
            <p class="mb-4">
                {{ __('dashboard.Data pendamping hanya dapat disimpan SEKALI. Pastikan semua data sudah benar sebelum menyimpan. Apakah Anda yakin ingin melanjutkan?') }}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelSave" wire:loading.attr="disabled">
                {{ __('dashboard.Batal') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="save" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ __('dashboard.Ya, Simpan Data') }}</span>
                <span wire:loading wire:target="save">{{ __('dashboard.Menyimpan...') }}</span>
            </x-button>
        </x-slot>
    </x-confirmation-modal>
</div>