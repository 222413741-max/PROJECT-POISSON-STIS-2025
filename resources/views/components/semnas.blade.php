@if ($submenu == 'poster')
    <div
        class="font-semibold tracking-wide text-left text-gray-600 bg-transparent text-s">
        <img src="{{ asset('img/poster-semnas-2025.png') }}" alt="Poster Seminar">
    </div>
@endif

@if ($submenu == 'deskripsi')
    <div class="font-semibold tracking-wide text-left text-gray-600 bg-transparent text-s">
        <p class="mb-5">{{ __('dashboard.Politeknik Statistika STIS kembali menyelenggarakan kegiatan tahunan yaitu Seminar Nasional Official Statistics 2025. Tema seminar nasional tahun ini adalah') }}  <i>"{{ __('dashboard.Peran Statistik Resmi Negara dalam Membangun Ekosistem Ekonomi Digital dan Kreatif untuk Pembangunan Berkelanjutan') }}"</i> {{ __('dashboard.dengan membuka') }} <i>Call For Papers</i> {{ __('dashboard.untuk subtema official statistics, sains data, dan aplikasi statistika yang masih terkait dengan tema. Seminar ini akan diisi oleh para pakar ternama dan dilaksanakan dengan tujuan untuk menambah wawasan tentang bagaimana statistik berperan penting dalam ekonomi digital dan pembangunan berkelanjutan.') }}
        </p>

        <p>{{ __('dashboard.Terdapat 3 (tiga) Subtema dari Seminar Nasional 2025, yaitu :') }}</p>
        <p>1. <i>Official Statistics</i></p>
        <p>2. {{ __('dashboard.Sains Data') }}</p>
        <p>3. {{ __('dashboard.Aplikasi Statistik') }}</p>

        <div class="mt-5">
            <p class="mb-3"><strong>{{ __('dashboard.KEYNOTE SPEAKER:') }}</strong></p>
            <p class="mb-2">👨‍🏫 {{ __('dashboard.Dr. Sonny Harry Budiotomo Harmadi, S.E., M.E. - Wakil Kepala BPS RI') }}</p>
            
            <p class="mb-3 mt-4"><strong>{{ __('dashboard.MODERATOR:') }}</strong></p>
            <p class="mb-2">👩‍🏫 {{ __('dashboard.Dr. Ray Sastri, M.Si. - Dosen Politeknik Statistika STIS') }}</p>
            
            <p class="mb-3 mt-4"><strong>{{ __('dashboard.INVITED SPEAKERS:') }}</strong></p>
            <p class="mb-2">👩‍🏫 {{ __('dashboard.Dian Permatasari, MIDeC. - Staf Ahli Menteri Bidang Riset, Pendidikan, dan Hubungan Kelembagaan, Kementerian Kominfo') }}</p>
            <p class="mb-2">👨‍🏫 {{ __('dashboard.Dr. Chaikal Nuryakin - Kepala Lembaga Penyelidikan Ekonomi dan Masyarakat (LPEM), Universitas Indonesia') }}</p>
            <p class="mb-2">👩‍🏫 {{ __('dashboard.Dr. Dini Maghfirra - Direktur Data, Pengembangan dan Pemerintah Digital dan Infrastruktur, Kementrian PPN/Bappenas') }}</p>
            <p class="mb-2">👨‍🏫 {{ __('dashboard.Prof. Dr. Hardius Usman - Guru Besar Politeknik Statistika STIS') }}</p>
        </div>

        <p class="mt-5">{{ __('dashboard.Informasi selengkapnya:') }}
            <a class="text-secondary-600" target="_blank" href="mailto:helpdesk@semnas.stis.ac.id">helpdesk@semnas.stis.ac.id</a></p>
            <a class="text-secondary-600" target="_blank" href="https://semnas.stis.ac.id">https://semnas.stis.ac.id</a>
    </div>
@endif

@if ($submenu == 'pendaftaran')
    <div class="font-semibold tracking-wide text-left text-gray-600 bg-transparent text-s">
        <p class="mb-5">{{ __('dashboard.Ayo Daftarkan Dirimu Segera dan Ikutilah Seminar Nasional pada Tanggal 19 September 2025 !') }}</p>
        
        <div class="mb-5">
            <p class="mb-3"><strong>{{ __('dashboard.Waktu dan Tempat Pelaksanaan:') }}</strong></p>
            <p class="mb-2">📅 {{ __('dashboard.Jumat, 19 September 2025') }}</p>
            <p class="mb-2">⏰ {{ __('dashboard.Seminar Panel: 07.30 - 11.00 WIB') }}</p>
            <p class="mb-2">⏰ {{ __('dashboard.Seminar Paralel: 13.00 - 16.30 WIB') }}</p>
            <p class="mb-2">💻 {{ __('dashboard.Online via Zoom dan disiarkan di YouTube') }}</p>
        </div>

        <p class="mb-5">{{ __('dashboard.Pendaftaran') }} <strong>{{ __('dashboard.GRATIS') }}</strong> {{ __('dashboard.dan mendapatkan e-certificate!') }}</p>
        
        <p class="mb-3">{{ __('dashboard.Buruan daftar, kuota terbatas!') }}</p>
        
        <p class="mb-5">{{ __('dashboard.Link Pendaftaran:') }} 
            <a class="text-secondary-600" href="https://event.stis.ac.id/semnas/2025" target="_blank">event.stis.ac.id/semnas/2025</a>
        </p>
        
        <p class="text-sm">{{ __('dashboard.Periode Pendaftaran: 15 Agustus - 15 September 2025') }}</p>
    </div>
@endif
