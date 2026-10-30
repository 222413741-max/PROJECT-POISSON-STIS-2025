<x-dashboard-layout title="official statistics challenge">
    <x-card>
        <h1 class="text-xl font-bold mb-3">{{ __('overview.Overview') }}</h1>
        <div class="mb-3">
            <h1 class="text-md font-semibold">{{ __('overview.Paket Soal :') }}</h1>
            <p>
                @switch(auth()->user()->TeamOSC()->getUserOrderInTeam())
                    @case(1)
                        {{ __('overview.Paket A') }}
                        @break
                    @case(2)
                        {{ __('overview.Paket B') }}
                        @break
                    @case(3)
                        {{ __('overview.Paket C') }}
                        @break
                    @default
                @endswitch
            </p>
        </div>
        <div class="mb-6">
            <h1 class="text-md font-semibold mb-4">{{ __('overview.Peraturan :') }}</h1>
            
            <ol class="space-y-1 text-sm leading-relaxed">
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">1.</span>
                    <span>{{ __('overview.Tiap tim akan mengakses soal lewat web, dengan satu tim menggunakan tiga device (satu peserta satu device) untuk mengakses soal. Jika satu tim hanya mempunyai satu device akan menjadi konsekuensi tim yang bersangkutan.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">2.</span>
                    <span>{{ __('overview.Pengerjaan soal tidak diawasi melalui Zoom Meeting.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">3.</span>
                    <span>{{ __('overview.Peserta diperbolehkan untuk membuka materi') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">4.</span>
                    <span>{{ __('overview.Jika terdapat gangguan atau kendala saat pengerjaan soal, peserta dapat menghubungi panitia/Contact Person (CP).') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">5.</span>
                    <span>{{ __('overview.Penilaian akhir berdasarkan skor kumulatif dari nilai masing-masing anggota dalam satu tim.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">6.</span>
                    <span>{{ __('overview.Jika terdapat dua atau lebih tim yang memiliki nilai akhir sama, pemeringkatan dilakukan berdasarkan waktu pengumpulan jawaban tercepat. Jika ditemukan waktu pengumpulan jawaban adalah sama, tim-tim bersangkutan akan sama-sama dinyatakan lolos ke tahap semifinal.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">7.</span>
                    <span>{{ __('overview.Keputusan juri tidak dapat diganggu gugat.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">8.</span>
                    <span>{{ __('overview.Pengumuman peringkat akan dilakukan pada Rabu, 15 Oktober 2025 melalui situs web dengan pemberitahuan lewat email dan grup WhatsApp.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">9.</span>
                    <span>{{ __('overview.Akan diambil sepuluh tim dengan nilai tertinggi untuk lanjut ke babak semifinal.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">10.</span>
                    <span>{{ __('overview.Tim yang lolos ke babak semifinal wajib melakukan daftar ulang.') }}</span>
                </li>
                
                <li class="flex">
                    <span class="font-medium mr-2 flex-shrink-0">11.</span>
                    <span>{{ __('overview.Jika terdapat tim yang tidak melakukan daftar ulang, tim tersebut dianggap gugur.') }}</span>
                </li>
            </ol>
        </div>
        
        <div class="mt-8">
            <h2 class="text-md font-semibold mb-4">{{ __('overview.Penilaian :') }}</h2>
            <p class="text-sm mb-3">{{ __('overview.Sistem penilaian:') }}</p>
            <ul class="space-y-2 text-sm ml-4">
                <li class="flex items-center">
                    <span class="w-2 h-2 bg-black rounded-full mr-3 flex-shrink-0"></span>
                    <span>{{ __('overview.Jawaban benar poin +3,') }}</span>
                </li>
                <li class="flex items-center">
                    <span class="w-2 h-2 bg-black rounded-full mr-3 flex-shrink-0"></span>
                    <span>{{ __('overview.Jawaban salah -1,') }}</span>
                </li>
                <li class="flex items-center">
                    <span class="w-2 h-2 bg-black rounded-full mr-3 flex-shrink-0"></span>
                    <span>{{ __('overview.Tidak menjawab poin 0') }}</span>
                </li>
            </ul>
        </div>

        <div class="flex justify-end mt-10">
            <x-button-link href="{{ route('lomba.osc.penyisihan', 1) }}">
                {{ __('overview.Masuk ke CBT') }}
            </x-button-link>
        </div>
    </x-card>
</x-dashboard-layout>