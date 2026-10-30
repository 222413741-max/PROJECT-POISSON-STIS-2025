@php
    $olimpiade = 'olimpiade';
    $infografis = 'infografis';
    $osc = 'osc';
@endphp

@if ($lomba == 'infografis')
    <div class="w-full overflow-x-hidden">
        <x-card name="{{ __('dashboard.kompetisi-' . $lomba) }}">
            @if (!$team)
                @if ($isClosed)
                    <div class="m-3 text-gray-700">
                        {{ __('dashboard.close-registration') }}
                    </div>
                @elseif ($isStarted)
                    <div class="flex flex-col items-center mt-3 shadow-sm">
                        <div class="w-full">
                            <x-teams.infog />
                        </div>
                    </div>
                @else
                    <div class="mt-3 text-gray-700">
                        {{ __('dashboard.lomba-belum-dibuka', ['lomba' => $lomba]) }}
                    </div>
                @endif
            @else
                {{-- @slot('right')
                <span class="text-sm">
                    @if ($team->confirmed)
                        <x-badges.success name="Sudah Diverifikasi" />
                    @else
                        <x-badges.error name="Menunggu Verifikasi" />
                    @endif
                </span>
            @endslot --}}

                {{-- anggota tim --}}
                <div class="mt-3">
                    <div class="flex justify-between px-2 text-gray-700">
                        <div class="font-bold ">{{ $team->name }} -
                            {{ ($team->type == 'olimpiade' ? 'SO' : ($team->type == 'infografis' ? 'SI' : 'OSC')) . $team->id }}
                        </div> 
                    </div>
                </div>
                <x-teams.users :users="$team->users" />

                {{-- pemnbayaran dan konfirmasi --}}
                <x-teams.confirmation :team="$team" />
                @if ($team->hasPermissionTo('infografis_final_peserta'))
                    <small class="mx-2 text-green-700">
                        {{ __('dashboard.tim-final-peserta') }}
                    </small>   
                @elseif ($team->hasPermissionTo('infografis_penyisihan_lolos'))
                    <small class="mx-2 text-green-700">
                        {{ __('dashboard.tim-penyisihan-lolos') }}
                    </small>
                @endif
                <x-teams.payments :payments="$team->payments" />
                
                {{-- List Lomba --}}
                <div class="mt-3">
                    <div class="flex justify-between px-2 text-gray-700">
                        <div class="font-bold ">{{ __('dashboard.babak-perlombaan') }}</div>
                    </div>
                </div>
                <x-teams.lomba :team="$team" />

            @endif
        </x-card>

        <x-section-border />
    </div>
@else
    <div class="w-full overflow-x-hidden">
        <x-card name="{{ __('dashboard.kompetisi-' . $lomba) }}">
            @if (!$team)
                @if ($isClosed)
                    <div class="m-3 text-gray-700">
                        {{ __('dashboard.close-registration') }}
                    </div>
                @elseif ($isStarted)
                    <div class="flex flex-col items-center mt-3 shadow-sm">
                        <div
                            class="grid w-full grid-cols-2 mb-2 text-center border rounded text-md lg:mr-4 lg:w-48 whitespace-nowrap">
                            <small
                                class="px-3 py-2 cursor-pointer {{ $buat_tim ? '' : 'hover:' }}bg-primaryPoi25 dark:text-gray-200"
                                wire:click="buatTim">{{ __('dashboard.buat-tim') }}</small>
                            <small
                                class="px-3 py-2 cursor-pointer {{ $buat_tim ? 'hover:' : '' }}bg-primaryPoi25 dark:text-gray-200"
                                wire:click="masukTim">{{ __('dashboard.gabung-tim') }}</small>
                        </div>
                        <div class="w-full">
                            @if ($buat_tim)
                                {{-- @if ($lomba == 'olimpiade')
                                <x-diskon :lomba="$olimpiade" />
                            @else
                                <x-diskon :lomba="$infografis" />
                            @endif
                            @if ($lomba == 'infografis')
                                <x-diskon :lomba="$infografis" />
                            @endif --}}

                                <x-teams.create />
                            @else
                                <x-teams.join />
                            @endif
                        </div>
                    </div>
                @else
                    <div class="mt-3 text-gray-700">
                        {{ __('dashboard.lomba-belum-dibuka', ['lomba' => $lomba]) }}
                    </div>
                @endif
            @else
                {{-- @slot('right')
                <span class="text-sm">
                    @if ($team->confirmed)
                        <x-badges.success name="Sudah Diverifikasi" />
                    @else
                        <x-badges.error name="Menunggu Verifikasi" />
                    @endif
                </span>
            @endslot --}}

                {{-- anggota tim --}}
                <div class="mt-3">
                    <div class="flex justify-between px-2 text-gray-700">
                        <div class="font-bold ">{{ $team->name }} -
                            {{ ($team->type == 'olimpiade' ? 'SO' : ($team->type == 'infografis' ? 'SI' : 'OSC')) . $team->id }}
                        </div>
                        @if ($team->payments->first()->confirmed)
                            <div>
                                Token : <span
                                    class="px-4 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full whitespace-nowrap">{{ $team->token }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($team->payments->first()->confirmed)
                    @if ($team->isFull())
                        @if ($team->confirmed)
                            <small class="mx-2 text-green-700">
                                {{ __('dashboard.tim-verifikasi') }}
                            </small>
                        @else
                            <small class="mx-2 text-red-700">
                                {{ __('dashboard.tim-lengkap') }}
                            </small>
                        @endif
                    @else
                        <small class="mx-2 text-red-600">
                            {{ __('dashboard.tim-belum-lengkap') }}
                        </small>
                    @endif
                @else
                    <small class="mx-2 text-red-600">
                        {{ __('dashboard.tim-belum-bayar') }}
                    </small>
                @endif


                <x-teams.users :users="$team->users" />

                {{-- pernyataan --}}
                @if ($team->hasPermissionTo('osc_penyisihan_lolos') || $team->hasPermissionTo('osc_semifinal_peserta'))
                    <div class="flex justify-between px-2 text-gray-700">
                        <div class="font-bold ">{{ __('dashboard.pernyataan') }}</div>
                    </div>
                    @if ($team->hasPermissionTo('osc_semifinal_peserta'))
                        <div class="flex flex-col items-start mb-4 ml-2">
                            <div class="w-1/2 md:flex md:items-center">
                                <div class="md:w-1/3">
                                    <label class="text-sm text-gray-600" for="pernyataan">File PDF <span
                                            class="text-sm text-red-600">(max 2 MB)</span> : </label>
                                </div>
                                <div class="md:w-2/3">
                                    <x-badges.success name="Terverifikasi" />
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- bagian upload file --}}
                        @if ($team->pernyataanOsc()->doesntExist())
                            <form wire:submit.prevent="addPernyataan({{ $team->id }})">
                            @else
                                <form wire:submit.prevent="updatePernyataan({{ $team->id }})">
                        @endif
                        <div class="flex flex-col items-start mb-4 ml-2">
                            <div class="w-1/2 md:flex md:items-center">
                                <div class="md:w-1/3">
                                    <label class="text-sm text-gray-600" for="pernyataan">File PDF <span
                                            class="text-sm text-red-600">(max 2 MB)</span> : </label>
                                </div>
                                <div class="md:w-2/3" x-data="{ 'pdf': @entangle('pernyataan_name') }">
                                    <input type="file" id="pdf" class="hidden" x-ref="pdf"
                                        wire:model.defer="pernyataan" x-on:change="pdf = $refs.pdf.files[0].name;" />
                                    <div
                                        class="flex justify-between border border-gray-300 rounded-md shadow-sm divide-x-1">
                                        <span class="p-2 overflow-hidden text-sm text-gray-700 whitespace-nowrap"
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
                        <div class="ml-2">
                            @if ($team->pernyataanOsc()->doesntExist())
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-1 mr-2 font-semibold text-white border border-transparent rounded-md cursor-pointer bg-secondaryPoi24-700 hover:text-white">
                                    <span>{{ __('dashboard.tambah-pernyataan') }}</span>
                                </button>
                                <x-download-button href="https://s.stis.ac.id/SuratPernyataanKetersediaanFinalOSC" target="_blank">Template</x-download-button>
                            @else
                                {{-- <button type="submit" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md cursor-pointer bg-secondaryPoi24-700 hover:text-white"> --}}
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white transition duration-300 ease-in-out border border-transparent rounded-md cursor-pointer bg-secondaryPoi24-700 hover:bg-green hover:text-gray-300">

                                    <span>{{ __('dashboard.update-pernyataan') }}</span>
                                </button>
                                <button wire:click="deletePernyataan({{ $team->id }})" type="button"
                                    class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white transition duration-300 ease-in-out bg-red-700 border border-transparent rounded-md cursor-pointer hover:bg-red-600 hover:text-gray-300">
                                    {{-- <button wire:click="deletePernyataan({{ $team->id }})" type="button" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white bg-red-700 border border-transparent rounded-md cursor-pointer hover:text-white"> --}}
                                    <span>{{ __('dashboard.hapus-pernyataan') }}</span>
                                </button>
                            @endif
                        </div>
                    @endif
                    </form>
                    {{-- problem di sini --}}
                    {{-- <x-teams.pernyataan_osc :pernyataan="$team->pernyataanOsc()" /> --}}
                @endif

                {{-- pemnbayaran dan konfirmasi --}}
                <x-teams.confirmation :team="$team" />
                @if ($team->hasPermissionTo('osc_final_peserta') || $team->hasPermissionTo('olimpiade_final_peserta'))
                    <small class="mx-2 text-green-700">
                        {{ __('dashboard.tim-final-peserta') }}
                    </small>   
                @elseif ($team->hasPermissionTo('osc_semifinal_lolos') || $team->hasPermissionTo('olimpiade_semifinal_lolos'))
                    <small class="mx-2 text-green-700">
                        {{ __('dashboard.tim-semifinal-lolos') }}
                    </small>
                @endif
                <x-teams.payments :payments="$team->payments" />

                {{-- List Lomba --}}
                <div class="mt-3">
                    <div class="flex px-2 text-gray-700 space-between">
                        <div class="font-bold ">{{ __('dashboard.babak-perlombaan') }}</div>
                    </div>
                </div>
                <x-teams.lomba :team="$team" />

            @endif
        </x-card>

        <x-section-border />
    </div>
@endif
