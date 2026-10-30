<x-sidebar-layout>
    <ul class="mt-6">
        <!-- home -->
        <x-dashboard.sidebar-item menu="beranda" href="{{ route('dashboard') }}" :title="$title">
            @slot('icon')
                <x-icons.home />
            @endslot
        </x-dashboard.sidebar-item>
        <!-- home -->

        <!-- profile -->
        <x-dashboard.sidebar-item menu="profil" href="{{ route('profile.show') }}" :title="$title">
            @slot('icon')
                <x-icons.user />
            @endslot
        </x-dashboard.sidebar-item>
        <!-- profile -->

        <!-- pengumuman -->
        <x-dashboard.sidebar-item menu="pengumuman" href="{{ route('pengumuman') }}" :title="$title">
            @slot('icon')
                <x-icons.bookmark />
            @endslot
        </x-dashboard.sidebar-item>
        <!-- pengumuman -->

        @role('peserta')
            <!-- lomba -->
            <x-dashboard.sidebar-item menu="perlombaan" href="{{ route('lomba') }}" :title="$title">
                @slot('icon')
                    <x-icons.file-text />
                @endslot
            </x-dashboard.sidebar-item>
            <!-- lomba -->

            <!-- semnas -->
            <x-dashboard.sidebar-item menu="seminar nasional" href="{{ route('semnas') }}" :title="$title">
                @slot('icon')
                    <x-icons.users />
                @endslot
            </x-dashboard.sidebar-item>
            <!-- semnas -->

            <!-- dn -->
            {{-- <x-dashboard.sidebar-item menu="dies natalis" href="{{ route('dn') }}" :title="$title">
                @slot('icon')
                    <x-icons.check-circle />
                @endslot
            </x-dashboard.sidebar-item> --}}
            <!-- dn -->
        @endrole

        @role('admin')
            {{-- admin --}}

            <div class="pt-6 font-bold">
                <div class="uppercase px-6 pb-3">
                    ADMIN
                </div>
                <ul>
                    <!-- user management-->
                    <x-dashboard.sidebar-item menu="pengguna" href="{{ route('users') }}" :title="$title">
                        @slot('icon')
                            <x-icons.user />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- user management -->

                    <!-- team -->
                    <x-dashboard.sidebar-item menu="tim" href="{{ route('teams') }}" :title="$title">
                        @slot('icon')
                            <x-icons.users />
                        @endslot
                    </x-dashboard.sidebar-item>

                    <!-- pembayaran-->
                    <x-dashboard.sidebar-item menu="pembayaran" href="{{ route('pembayaran') }}" :title="$title">
                        @slot('icon')
                            <x-icons.money />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- pembayaran -->

                    <!-- tanggal-->
                    <x-dashboard.sidebar-item menu="tanggal" href="{{ route('tanggal') }}" :title="$title">
                        @slot('icon')
                            <x-icons.tanggal />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- pembayaran -->
                </ul>
            </div>


            {{-- olimpiade --}}
            @hasanyrole('qj|so')
            <div class="pt-6 font-bold">
                <div class="uppercase px-6 pb-3">
                    {{ __('dashboard.olimpiade') }}
                </div>
                <ul>
                    @role('qj')
                    <!-- soal-->
                    <x-dashboard.sidebar-item menu="soal" href="{{ route('olimpiade.soal') }}" :title="$title">
                        @slot('icon')
                            <x-icons.file-text />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- soal -->
                    @endrole
                    <!-- jawaban-->
                    @role('so')
                    <x-dashboard.sidebar-item menu="jawaban" href="{{ route('olimpiade.jawaban') }}" :title="$title">
                        @slot('icon')
                            <x-icons.check-circle />
                        @endslot
                    </x-dashboard.sidebar-item>
                    @endrole
                    <!-- jawaban -->
                </ul>
            </div>
            @endhasanyrole

            {{-- infografis --}}
            @role('si')
            <div class="pt-6 font-bold">
                <div class="uppercase px-6 pb-3">
                    {{ __('dashboard.infografis') }}
                </div>
                <ul>
                    <!-- pengumpulan-->
                    <x-dashboard.sidebar-item menu="pengumpulan" href="{{ route('infografis.pengumpulan') }}"
                        :title="$title">
                        @slot('icon')
                            <x-icons.folder-plus />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- pengumpulan -->
                </ul>
            </div>
            @endrole

            {{-- osc --}}
            @hasanyrole('qj|osc')
            <div class="pt-6 font-bold">
                <div class="uppercase px-6 pb-3">
                    {{ __('dashboard.osc') }}
                </div>
                <ul>
                    @role('qj')
                    <!-- soal-->
                    <x-dashboard.sidebar-item menu="soal penyisihan" href="{{ route('osc.soal_osc') }}" :title="$title">
                        @slot('icon')
                            <x-icons.file-text />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- soal -->
                    <!-- soal-->
                    <x-dashboard.sidebar-item menu="soal semifinal" href="{{ route('osc.soal_semifinal_osc') }}" :title="$title">
                        @slot('icon')
                            <x-icons.file-text />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- soal -->
                    @endrole
                    @role('osc')
                    <!-- jawaban penyisihan -->
                    <x-dashboard.sidebar-item menu="jawaban penyisihan" href="{{ route('osc.jawaban_osc') }}" :title="$title">
                        @slot('icon')
                            <x-icons.check-circle />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- jawaban penyisihan -->
                    <!-- pernyataan -->
                    <x-dashboard.sidebar-item menu="surat pernyataan" href="{{ route('osc.pernyataan_osc') }}" :title="$title">
                        @slot('icon')
                            <x-icons.check-circle />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- pernyataan -->
                    <!-- jawaban semifinal -->
                    <x-dashboard.sidebar-item menu="jawaban semifinal" href="{{ route('osc.jawaban_semifinal_osc') }}" :title="$title">
                        @slot('icon')
                            <x-icons.check-circle />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- jawaban semifinal -->
                    <x-dashboard.sidebar-item menu="pendamping final" href="{{ route('osc.pendamping_final_osc') }}" :title="$title">
                        @slot('icon')
                            <x-icons.users />
                        @endslot
                    </x-dashboard.sidebar-item>
                    <!-- pendamping final -->

                    <!-- pendamping final -->
                    @endrole
                </ul>
            </div>
            @endhasanyrole
        @endrole
    </ul>
</x-sidebar-layout>
