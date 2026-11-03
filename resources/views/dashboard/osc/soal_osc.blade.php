<x-dashboard-layout title="soal penyisihan">
    <x-card name="list soal (PG)">
        @slot('right')
            {{-- @livewire('soal_osc.create') --}}
            <x-button-link href="{{ route('osc.create') }}" class="mx-2" wire:click="">TAMBAH SOAL</x-button-link>
        @endslot
        @livewire('soal_osc.table_osc')
    </x-card>
</x-dashboard-layout>
