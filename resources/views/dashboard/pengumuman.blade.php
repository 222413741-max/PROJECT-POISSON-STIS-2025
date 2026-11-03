<x-dashboard-layout title="pengumuman">
    <x-card name="{{ __('dashboard.daftar pengumuman') }}">
        @role('admin')
        @slot('right')
            @livewire('pengumuman.add')
        @endslot
        @endif
        @livewire('pengumuman.table')
    </x-card>
</x-dashboard-layout>
