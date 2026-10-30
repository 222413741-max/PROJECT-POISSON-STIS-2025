<div>
    {{-- Information --}}
    <x-form-section submit="">
        <x-slot name="title">
            {{ __('dashboard.Informasi Infografis') }}
        </x-slot>

        <x-slot name="description">
            {{ __('dashboard.Judul dan Deskripsi Infografis') }}
        </x-slot>

        <x-slot name="form">

            <!-- Team -->
            <div class="col-span-6">
                <x-label for="name" value="{{ __('dashboard.Nama Tim') }}" />
                <x-input id="name" type="text" class="block w-full mt-1" value="{{ $team->name }}" disabled />
            </div>

            <!-- Name -->
            <div class="col-span-6">
                <x-label for="name" value="{{ __('dashboard.Judul Infografis') }}" />
                <x-input id="name" type="text" class="block w-full mt-1" value="{{ $data->name }}"
                    disabled />
            </div>

            <!-- Deskripsi -->
            <div class="col-span-6">
                <x-label for="description" value="{{ __('dashboard.Deskripsi Infografis') }}" />
                <x-textarea id="description" rows="10" class="mt-1" disabled>{{ $data->description }}
                </x-textarea>
            </div>

        </x-slot>

    </x-form-section>

    <x-section-border />

    {{-- File --}}
    <x-form-section>
        <x-slot name="title">
            {{ __('dashboard.Unggah File') }}
        </x-slot>

        <x-slot name="description">
            {{ __('dashboard.Unggah materi presentasi yang akan digunakan') }}
        </x-slot>

        <x-slot name="form">

            {{-- Infografis --}}
            <div class="col-span-6">
                <x-label for="name" value="{{ __('dashboard.File Infografis') }}" />
                <div class="flex justify-between border border-gray-300 rounded-md shadow-sm divide-x-1">
                    <span class="p-2 overflow-hidden text-sm text-gray-400 whitespace-nowrap">
                        {{ $data->infografis }}
                    </span>
                    <div class="flex">
                        @if ($data->infografis)
                            <x-button type="button" class="rounded-tl-none rounded-bl-none">
                                <a href="{{ $this->getPresignedUrl(ltrim(parse_url($data->infografis, PHP_URL_PATH), '/')) }}" download>{{ __('dashboard.Unduh') }}</a>
                            </x-button>
                        @endif
                    </div>
                </div>
            </div>


            {{-- presentation --}}
            <div class="col-span-6" x-data="{ ppt: @entangle('ppt') }">
                <x-label for="name" value="{{ __('dashboard.File Presentasi') }}" />
                {{-- file input --}}
                <input type="file" id="ppt" class="hidden" x-ref="ppt"
                    x-on:change="ppt = $refs.ppt.files[0].name;" />
                <div class="flex justify-between border border-gray-300 rounded-md shadow-sm divide-x-1">
                    <span class="p-2 overflow-hidden text-sm text-gray-400 whitespace-nowrap" x-text="ppt"></span>
                    <div class="flex">
                        @if (!$isDisabled)
                            <x-secondary-button type="button" class="rounded-none whitespace-nowrap"
                                x-on:click.prevent="$refs.ppt.click()">
                                {{ __('dashboard.Pilih File') }}
                            </x-secondary-button>
                        @endif
                        @if ($data->ppt)
                        <x-button type="button" class="rounded-tl-none rounded-bl-none">
                            <a href="{{ $this->getPresignedUrl(ltrim(parse_url($data->ppt, PHP_URL_PATH), '/')) }}" download>{{ __('dashboard.Unduh') }}</a>
                        </x-button>
                        @endif
                    </div>
                </div>
                <p class="text-sm text-red-600">* {{ __('dashboard.File yang diunggah harus berupa powerpoint') }}</p>
            </div>

        </x-slot>

        @if (!$isDisabled)
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

    <script src="{{ asset('js/uploadHandling.js') }}" defer></script>
    <script>
        async function upload(team) {
            const lomba = 'infografis'

            // Disable button
            el('submit_file').disabled = true;
            el('loading').classList.remove('hidden')

            try {
                const ppt = await uploadFiles('ppt', lomba, team);

                Livewire.emit('saveFile', ppt)
            } catch (error) {
                Livewire.emit('error', error)
            } finally {
                el('submit_file').disabled = false;
                el('loading').classList.add('hidden')
            }
        }
    </script>

</div>
