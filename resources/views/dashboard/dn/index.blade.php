<x-dashboard-layout title="dies natalis">
    @php
        $poster = 'poster';
        $deskripsi = 'deskripsi';
        $pendaftaran = 'pendaftaran';
    @endphp
    <x-card class="poster">
        <x-dn :submenu="$poster" />
    </x-card>
    <x-card name="deskripsi">
        <x-dn :submenu="$deskripsi" />
    </x-card>
    {{-- <x-card name="pendaftaran">
        <x-dn :submenu="$pendaftaran" />
    </x-card> --}}
</x-dashboard-layout>
