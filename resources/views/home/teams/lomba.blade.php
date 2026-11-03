<x-table :theads="['nama', 'grup-wa', 'tanggal','tautan']">
    {{-- Olimpiade --}}
    @if ($team->hasPermissionTo('olimpiade_penyisihan_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Penyisihan Olimpiade Statistik') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_penyisihan_so }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>{{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Penyisihan Olimpiade Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href=" {{ route('lomba.olimpiade.penyisihan') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif
    @if ($team->hasPermissionTo('olimpiade_semifinal_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Semifinal Olimpiade Statistik') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_semifinal_so }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>{{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Semifinal Olimpiade Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href=" {{ route('lomba.olimpiade.semifinal') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif
    @if ($team->hasPermissionTo('olimpiade_final_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Final Olimpiade Statistik') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_final_so }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Final Olimpiade Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y') }}
                    -
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Final Olimpiade Berakhir')->pluck('time')->first()))->isoFormat('D MMMM Y') }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href=" {{ route('lomba.olimpiade.final') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif

    {{-- infografis --}}
    @if ($team->hasPermissionTo('infografis_penyisihan_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Penyisihan Infografis Statistik') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_penyisihan_si }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Penyisihan Infografis Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y') }}
                    -
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Penyisihan Infografis Berakhir')->pluck('time')->first()))->isoFormat('D MMMM Y') }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href=" {{ route('lomba.infografis.penyisihan') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif
    @if ($team->hasPermissionTo('infografis_final_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Final Infografis Statistik') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_final_si }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Final Infografis Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y')  }}
                    -
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Final Infografis Berakhir')->pluck('time')->first()))->isoFormat('D MMMM Y')  }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href=" {{ route('lomba.infografis.final') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif

    {{-- OSC --}}
    @if ($team->hasPermissionTo('osc_penyisihan_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Penyisihan OSC') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_penyisihan_osc }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Penyisihan OSC Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y HH:mm:ss')  }}
                    -
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Penyisihan OSC Berakhir')->pluck('time')->first()))->isoFormat('D MMMM Y HH:mm:ss')  }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href="{{ route('lomba.osc.penyisihan.overview') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif
    @if ($team->hasPermissionTo('osc_semifinal_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Semifinal OSC') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_semifinal_osc }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Semifinal OSC Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y HH:mm:ss')  }}
                    -
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Semifinal OSC Berakhir')->pluck('time')->first()))->isoFormat('D MMMM Y HH:mm:ss')  }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href="{{ route('lomba.osc.semifinal') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif
    @if ($team->hasPermissionTo('osc_final_peserta'))
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ __('dashboard.Babak Final OSC') }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <x-nav-link target="_blank" class="inline-flex items-center justify-center px-4 py-2 font-semibold text-white border border-transparent rounded-md bg-secondaryPoi24-700 hover:text-white" href="{{ $grup_wa_final_osc }}">
                    <span>{{ __('dashboard.grup-wa') }}</span>
                </x-nav-link>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Final OSC Mulai')->pluck('time')->first()))->isoFormat('D MMMM Y HH:mm:ss')  }}
                    -
                    {{ (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Final OSC Berakhir')->pluck('time')->first()))->isoFormat('D MMMM Y HH:mm:ss')  }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <a class="underline" href="{{ route('lomba.osc.final') }}">
                    {{ __('dashboard.Tautan Lomba') }}
                </a>
            </td>
        </tr>
    @endif
</x-table>
