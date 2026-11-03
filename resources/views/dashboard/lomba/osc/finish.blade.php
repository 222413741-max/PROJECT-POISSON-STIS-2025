<x-dashboard-layout title="official statistics challenge">
    <x-card>
        <h1 class="text-xl font-bold mb-3">Ujian Telah Selesai</h1>
        <h3 class="text-md">Silahkan tunggu pengumuman selanjutnya!</h3>
        <div class="flex gap-5 mt-8 justify-center">
            <x-button-link href="{{ route('dashboard') }}">
                Kembali Ke Dashboard
            </x-button-link>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-button-link color='bg-red-800' href="{{ route('logout') }}"
                    @click.prevent="$root.submit();">
                    {{ __('Keluar') }}
                </x-button-link>
            </form>
        </div>
    </x-card>
</x-dashboard-layout>
