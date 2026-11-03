<div>
    {{-- Information --}}
    <x-form-section submit="save">
        <x-slot name="title">
            {{ __('dashboard.Informasi Infografis') }}
        </x-slot>

        <x-slot name="description">
            {{ __('dashboard.Isikan judul dan deskripsi dari infografis yang anda buat') }}
        </x-slot>

        <x-slot name="form">

            <!-- Team -->
            <div class="col-span-6">
                <x-label for="name" value="{{ __('dashboard.Nama Tim') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" value="{{ $team->name }}" disabled />
            </div>

            <!-- Name -->
            <div class="col-span-6">
                <x-label for="name" value="{{ __('dashboard.Judul Infografis') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"
                    disabled="{{ $isDisabled }}" />
            </div>

            <!-- Deskripsi -->
            <div class="col-span-6">
                <x-label for="description" value="{{ __('dashboard.Deskripsi Infografis') }}" />
                <x-textarea wire:model.defer="description" rows="10" id="description"
                    disabled="{{ $isDisabled }}"></x-textarea>
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('dashboard.Tersimpan.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" :disabled="$isDisabled">
                {{ __('dashboard.Simpan') }}
            </x-button>
        </x-slot>
    </x-form-section>

    <x-section-border />

    @if ($data)
        {{-- File --}}
        <x-form-section>
            <x-slot name="title">
                {{ __('dashboard.Unggah File') }}
            </x-slot>

            <x-slot name="description">
                {{ __('dashboard.Unggah bukti orisinalitas dan file infografis yang anda buat dalam satu file zip. Anda hanya bisa mengunggah satu kali, pastikan apa yang anda unggah sudah sesuai ketentuan.') }}
            </x-slot>

            <x-slot name="form">

                {{-- Infografis --}}
                <div class="col-span-6" x-data="{ infografis: @entangle('infografis') }">
                    <x-label for="name" value="{{ __('dashboard.File Infografis') }}" />
                    {{-- file input --}}
                    <input type="file" id="infografis" class="hidden" x-ref="infografis"
                        x-on:change="infografis = $refs.infografis.files[0].name;" />
                    <div class="flex divide-x-1 border rounded-md shadow-sm border-gray-300 justify-between">
                        <span class="text-gray-400 text-sm p-2 overflow-hidden whitespace-nowrap"
                            x-text="infografis"></span>
                        <div class="flex">
                            {{-- open 1 time, cannot edit --}}
                            @if ($data->infografis)
                                <x-button-link href="{{ $this->getPresignedUrl(ltrim(parse_url($data->infografis, PHP_URL_PATH), '/')) }}">{{ __('dashboard.Unduh') }}</x-button-link>
                            @else
                                @if (!$isDisabled)
                                    <x-secondary-button type="button" class="rounded-none whitespace-nowrap"
                                        x-on:click.prevent="$refs.infografis.click()">
                                        {{ __('dashboard.Pilih File') }}
                                    </x-secondary-button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

            </x-slot>

            @if (!$data->infografis)
                <x-slot name="actions">
                    <x-loading />
                    <x-button type="button" onclick="upload('{{ $team->id }}')" class="ml-1"
                        id="submit_file">
                        {{ __('dashboard.Simpan') }}
                    </x-button>
                </x-slot>
            @endif
        </x-form-section>

        <x-section-border />
 
        {{-- @push('scripts') --}}
        <script src="{{ asset('js/uploadHandling.js') }}" defer></script>
        <script>
            async function upload(team) {
                const lomba = 'infografis'

                // Disable button
                el('submit_file').disabled = true;
                el('loading').classList.remove('hidden')

                try {
                    const infografis = await uploadFiles('infografis', lomba, team);

                    Livewire.emit('saveFile', infografis)
                } catch (error) {
                    Livewire.emit('error', error)
                } finally {
                    el('submit_file').disabled = false;
                    el('loading').classList.add('hidden')
                }
            }
        </script>
        {{-- @endpush --}}
    @endif

</div>
