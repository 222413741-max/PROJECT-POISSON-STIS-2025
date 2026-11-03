<x-dashboard-layout title="pengguna">
    <x-card name="Daftar Pengguna">
        @slot('right')
            @livewire('users.add-admin')
        @endslot
        @livewire('users.table')
    </x-card>
</x-dashboard-layout>
