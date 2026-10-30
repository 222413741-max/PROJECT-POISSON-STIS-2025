<div>
    {{-- Information --}}
    <x-form-section submit="save">
        <x-slot name="title">
            {{ __('dashboard.Informasi Semifinal Olimpiade') }}
        </x-slot>

        <x-slot name="description">
            {{ __('dashboard.Unggah makalah') }}
        </x-slot>

        <x-slot name="form">
            <!-- Team -->
            <div class="col-span-6">
                <x-label for="name" value="{{ __('dashboard.Nama Tim') }}" />
                <x-input id="name" type="text" class="block w-full mt-1" value="{{ $team->name }}" disabled />
            </div>

            <div class="col-span-6" x-data="{ olimpiade: @entangle('olimpiade') }">
                <x-label for="name" value="{{ __('dashboard.File Makalah') }}" />
                {{-- file input --}}
                <input type="file" id="olimpiade" class="hidden" x-ref="olimpiade"
                    x-on:change="olimpiade = $refs.olimpiade.files[0].name;" />
                <div class="flex justify-between border border-gray-300 rounded-md shadow-sm divide-x-1">
                    <span class="p-2 overflow-hidden text-sm text-gray-400 whitespace-nowrap"
                        x-text="olimpiade"></span>
                    <div class="flex">
                        {{-- open 1 time, cannot edit --}}
                        @if ($data)
                            <x-button-link href="{{ $this->getPresignedUrl(ltrim(parse_url($olimpiade, PHP_URL_PATH), '/')) }}">{{ __('dashboard.Unduh') }}</x-button-link>
                        @else
                            @if (!$isDisabled)
                                <x-secondary-button type="button" class="rounded-none whitespace-nowrap"
                                    x-on:click.prevent="$refs.olimpiade.click()">
                                    {{ __('dashboard.Pilih File') }}
                                </x-secondary-button>
                            @endif
                        @endif
                    </div>
                </div>
                <p class="text-sm text-red-600">* {{ __('dashboard.File yang diunggah harus berupa pdf') }}</p>
            </div>
        </x-slot>

        @if (!$data)
        <x-slot name="actions">
            <x-loading />
            <x-button type="button" onclick="upload('{{ $team->id }}')" class="ml-1"
                id="submit_file">
                {{ __('dashboard.Simpan') }}
            </x-button>
        </x-slot>
        @endif
    </x-form-section> 

    <script src="{{ asset('js/uploadHandling.js') }}" defer></script>
    <script>
        async function upload(team) {
            const lomba = 'olimpiade'

            // Disable button
            el('submit_file').disabled = true;
            el('loading').classList.remove('hidden')

            try {
                const olimpiade = await uploadFiles('olimpiade', lomba, team);

                Livewire.emit('saveFile', olimpiade)
            } catch (error) {
                Livewire.emit('error', error)
            } finally {
                el('submit_file').disabled = false;
                el('loading').classList.add('hidden')
            }
        }
    </script>
</div>
