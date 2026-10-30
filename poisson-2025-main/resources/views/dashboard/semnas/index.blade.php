<x-dashboard-layout title="seminar nasional">
    @php
        $poster = 'poster';
        $deskripsi = 'deskripsi';
        $pendaftaran = 'pendaftaran';
    @endphp
    <x-card class="poster">
        <x-semnas :submenu="$poster" />
    </x-card>
    <x-card name="deskripsi">
        <x-semnas :submenu="$deskripsi" />
    </x-card>
    {{-- <x-card name="pendaftaran">
        <x-semnas :submenu="$pendaftaran" />
    </x-card> --}}
</x-dashboard-layout>
