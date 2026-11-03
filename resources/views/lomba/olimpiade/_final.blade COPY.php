<div>
    <x-card name="{{ __('dashboard.babak-' . $TAHAP) }}">
        @slot('right')
            @if ($data)
                <x-download-button href="{{ $data->soal->soal_url }}">{{ __('dashboard.Unduh') }}</x-download-button>
            @else
                @if ($now->betweenIncluded($startTime, $endTime))
                    <x-button wire:click="generateSoal">{{ __('dashboard.Generate Soal') }}</x-button>
                @endif
            @endif
        @endslot
        @if (!$data)
            <div>
                <div class="mt-3">
                    <div class="text-gray-300 flex justify-between px-2">
                        <div class="font-bold ">{{ $team->name }}</div>
                    </div>
                </div>
                <small class="text-gray-400 mx-2">
                    @if ($now->betweenIncluded($startTime, $endTime))
                        {{ __('dashboard.Anda belum memulai ujian, silahkan tekan generate soal untuk memulai ujian!') }}
                    @else
                        @if ($endTime->isPast())
                            {{ __('dashboard.Anda Tidak Mengikuti Perlombaan') }}
                        @endif
                        @if ($startTime->isFuture())
                            {{-- Perlombaan belum di mulai, harap bersiap siap karena perlombaan dimulai pada
                            {{ $startTime->format('H:i') }}. Harap reload halaman jika tidak berubah. --}}
                            {{ __('dashboard.not-started', ['time' => $startTime->format('H:i')]) }}
                        @endif
                    @endif
                </small>
            </div>
        @else
            <div class="grid lg:grid-cols-2">
                <div>
                    <div class="xl:flex my-4">
                        <div class="xl:w-1/2">
                            <span class="text-gray-500">{{ __('dashboard.Tanggal') }}</span>
                        </div>
                        <div class="xl:w-1/2 text-gray-300">
                            {{ $startTime->isoFormat('D MMMM Y') }}
                            -
                            {{ $endTime->isoFormat('D MMMM Y') }}
                        </div>
                    </div>
                    <div class="xl:flex items-center my-4">
                        <div class="xl:w-1/2">
                            <span class="text-gray-500">{{ __('dashboard.Mekanisme Pengerjaan') }}</span>
                        </div>
                        <div class="xl:w-1/2">
                            <x-download-button href="{{ $guideLink }}" target="_blank" rel="noopener noreferrer"
                                download="false">
                                {{ __('dashboard.Mekanisme Pengerjaan') }}
                            </x-download-button>
                        </div>
                    </div>
                    <div class="xl:flex my-4">
                        <div class="xl:w-1/2">
                            <span class="text-gray-500">{{ __('dashboard.Kode Soal') }}</span>
                        </div>
                        <div class="xl:w-1/2">
                            <span class="whitespace-nowrap px-4 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">{{ $data->soal->code }}</span>
                        </div>
                    </div>
                    <div class="xl:flex my-4">
                        <div class="xl:w-1/2">
                            <span class="text-gray-500">{{ __('dashboard.Kata Sandi Soal') }}</span>
                        </div>
                        <div class="xl:w-1/2">
                            <span class="whitespace-nowrap px-4 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">{{ $data->soal->password }}</span>
                        </div>
                    </div>
                    <div class="xl:flex my-4">
                        <div class="xl:w-1/2">
                            <span class="text-gray-500">{{ __('dashboard.Unggah') }}</span>
                        </div>
                        <div class="xl:w-1/2">
                            @if ($data->url)
                                <span class="dark:text-gray-300">{{ (new \Carbon\Carbon($data->uploaded_at))->format('d M Y H:i') }}</span>
                            @else
                                <span class="text-xs">
                                    <x-badges.error name="{{ __('dashboard.Belum Unggah') }}" />
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-full">
                        @if ($now->betweenIncluded($startTime, $endTime))
                            <div x-data="{ jawaban: @entangle('jawaban') }" class="mb-6">
                                {{-- file input --}}
                                <input type="file" id="jawaban" class="hidden" x-ref="jawaban"
                                    x-on:change="jawaban = $refs.jawaban.files[0].name;" />
                                <div
                                    class="flex lg:border rounded-md shadow-sm border-gray-300 justify-center lg:justify-between items-center">
                                    <x-loading />
                                    <span class="hidden lg:block 1 text-gray-400 text-sm p-2 truncate"
                                        x-text="jawaban"></span>
                                    <div class="flex">
                                        <x-secondary-button type="button" class="whitespace-nowrap"
                                            x-on:click.prevent="$refs.jawaban.click()">
                                            {{ __('dashboard.Pilih File') }}
                                        </x-secondary-button>
                                        <x-secondary-button type="button" onclick="upload('{{ $team->id }}')"
                                            class="ml-1" id="submit_file">
                                            {{ __('dashboard.Unggah') }}
                                        </x-secondary-button>
                                        @if ($data->url)
                                            <x-button type="button" class="md:rounded-tl-none md:rounded-bl-none">
                                                <a href="{{ $data->url }}" download>{{ __('dashboard.Unduh') }}</a>
                                            </x-button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </x-card>

    <script src="{{ asset('js/uploadHandling.js') }}" defer></script>
    <script type="text/javascript">
        async function upload(team) {
            const lomba = 'olimpiade'

            // Disable button
            el('submit_file').disabled = true;
            el('loading').classList.remove('hidden')

            try {
                const jawaban = await uploadFiles('jawaban', lomba, team);

                Livewire.emit('saveFile', jawaban)
            } catch (error) {
                Livewire.emit('error', error)
            } finally {
                el('submit_file').disabled = false;
                el('loading').classList.add('hidden')
            }
        }
    </script>
</div>
