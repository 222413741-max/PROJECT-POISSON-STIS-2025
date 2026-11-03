<x-dashboard-layout title="Official Statistics Challenge - Final">
    @php
        $final_start = \Carbon\Carbon::parse(\App\Models\Tanggal::where('kegiatan', 'Final OSC Mulai')->pluck('time')->first());
        $guideline = 'https://drive.google.com/file/d/1n5900MmsArxcb-fnfzsK9AhdTGKkF2xa/view?usp=drive_link';
    @endphp
    <div class="flex flex-col justify-end w-full mb-5 text-right">
        <div>
            <span>{{ __('dashboard.Batas Pengisian') }} : </span>
            <x-badges.success>
                @slot('name')
                {{ $final_start->format('d F Y H:i:s') }}
                @endslot
            </x-badges.success>
        </div>
        <div class="flex flex-row items-center justify-end gap-3 mt-5">
            <x-download-button href="{{ $guideline }}" target="_blank">{{ __('dashboard.Guideline') }}</x-download-button>
        </div>
    </div>
    
    @livewire('lomba.osc.final-osc')
</x-dashboard-layout>