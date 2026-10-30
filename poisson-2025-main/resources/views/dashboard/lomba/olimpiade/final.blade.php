<x-dashboard-layout title="olimpiade statistik">
    @php
        $time_left = \Carbon\Carbon::parse(\App\Models\Tanggal::where('kegiatan', 'Final Olimpiade Berakhir')->pluck('time')->first());
        $guideline = 'https://drive.google.com/file/d/1LlshLeAK2k_9aY3Fmn14r4MZVpUxZZOT/view?usp=sharing';
        $template = 'https://s.stis.ac.id/FormatMakalahPoisson2024';
        $studi_kasus = \App\Models\Soal::where('type', 'semifinal')->first();
    @endphp
    <div class="flex flex-col justify-end w-full mb-5 text-right">
        <div>
            <span>{{ __('dashboard.Waktu Berakhir') }} : </span>
            <x-badges.success>
                @slot('name')
                {{ $time_left->format('d F Y H:i:s') }}
                @endslot
            </x-badges.success>
        </div>
        <div class="flex flex-row items-center justify-end gap-3 mt-5">
            <div>
                <span>{{ __('Password') }} : </span>
                <x-badges.warning>
                    @slot('name')
                    {{ $studi_kasus->password }}
                    @endslot
                </x-badges.warning>
            </div>
            <x-download-button href="{{ asset('storage/' . $studi_kasus->path ?? '') }}" target="_blank">{{ __('dashboard.Studi Kasus') }}</x-download-button>
            <x-download-button href="{{ $guideline }}" target="_blank">{{ __('dashboard.Guideline') }}</x-download-button>
            <x-download-button href="{{ $template }}" target="_blank">{{ __('dashboard.Template Makalah') }}</x-download-button>
        </div>
    </div>
    @livewire('lomba.olimpiade.semifinal')

    <div class="mt-10">
        @livewire('lomba.olimpiade.final-so')
    </div>
</x-dashboard-layout>
