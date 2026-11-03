
    <x-dashboard-layout title="tanggal">
        <x-card name="daftar tanggal">
            @role('admin')
            @slot('right')
                @livewire('tanggal.update')
            @endslot
            @endif
            @livewire('tanggal.table')
        </x-card>
    </x-dashboard-layout>

