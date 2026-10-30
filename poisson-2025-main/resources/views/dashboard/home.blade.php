<x-dashboard-layout title="beranda">
    @role('admin')
        @include('home.admin')
    @else
        @role('peserta')
            @if(auth()->user()->university_tipe == 0)
                @livewire('home.users', ['lomba' => 'olimpiade']) 

                @livewire('home.users', ['lomba' => 'infografis'])
            @elseif (auth()->user()->university_tipe == 1) 
                @livewire('home.users', ['lomba' => 'osc'])
            @elseif (auth()->user()->university_tipe == 2)
                @livewire('home.users', ['lomba' => 'infografis'])
            @endif
        @else
            @php
                $isClosed = (new \Carbon\Carbon(App\Models\Tanggal::where('kegiatan', 'Penutupan Pendaftaran Lomba Infografis')->pluck('time')->first()))->isPast();
            @endphp
            @if ($isClosed)
                <x-cta>
                    {{ __('dashboard.close-registration') }}
                </x-cta>
            @else 
                <x-cta>
                    {{ __('dashboard.Anda belum diverifikasi oleh admin, harap lengkapi data dan persyaratan terlebih dahulu.') }}<br><br>
                    {{ __('dashboard.Akun akan diverifikasi jika telah memenuhi hal-hal berikut.') }} <br>
                    1) {{ __('dashboard.Data profil lengkap') }} <br>
                    2) {{ __('dashboard.Unggah') }} <a class="underline font-bold" href="https://drive.google.com/drive/folders/1GtHEWDNZpzDHTFefFQWs3cVwCTC3lcCG?usp=sharing" target="_blank" rel="noopener noreferrer">twibbon</a> {{ __('dashboard.di Instagram & tag akun Poisson') }}<br>
                    3) {{ __('dashboard.Follow akun instagram') }} <a class="underline font-bold" href="https://instagram.com/poisson_stis" target="_blank" rel="noopener noreferrer">@poisson_stis</a> ({{ __('dashboard.akan dicek sesuai akun yang digunakan untuk mengunggah twibbon') }})<br>
                    {{-- Tambahkan notes warna merah kecil, jadikan poin --}}
                    <div class="leading-[0.8rem] mt-2">
                        <span class="text-red-500 text-xs">Notes:</span><br>
                        <span class="text-red-500 text-xs">- {{ __('dashboard.notes1') }}</span><br>
                        <span class="text-red-500 text-xs">- {{ __('dashboard.notes2') }}</span><br>
                        <span class="text-red-500 text-xs">- {{ __('dashboard.notes3') }}</span>
                        </div>
                    
                </x-cta>
            @endif
        @endrole
    @endrole
</x-dashboard-layout>
