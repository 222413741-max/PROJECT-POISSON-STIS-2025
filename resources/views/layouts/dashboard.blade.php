<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="initData()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title and descriptioan --}}
    {{-- Keperluan translate dimatikan dulu --}}
    {{-- <title>{{ ucfirst(__('dashboard.' . $title)) }} - Poisson : Pekan Olimpiade Statistika Nasional</title> --}}
    <title>{{ ucfirst(__($title)) }} - Poisson : Pekan Olimpiade Statistika Nasional</title>
    <meta name="description"
        content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingakt nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />

    {{-- meta opengraph --}}
    <meta property="og:site_name" content="https://poisson.stis.ac.id" />
    <meta property="og:title" content="{{ ucfirst($title) }} - Poisson : Pekan Olimpiade Statistika Nasional" />
    <meta property="og:description"
        content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingakt nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />
    <meta property="og:image" content="https://poisson.stis.ac.id/static/landing-page.png" />
    <meta property="og:type" content="website" />

    {{-- twitter card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ ucfirst($title) }} - Poisson : Pekan Olimpiade Statistika Nasional" />
    <meta name="twitter:description"
        content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingakt nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />
    <meta name="twitter:image" content="https://poisson.stis.ac.id/static/landing-page.png" />


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    {{-- fonts.google.com : Archivo --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
    <link href="https://fonts.googleapis.com/css2?family=Archivo&display=swap" rel="stylesheet" />

    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-2025-icon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-2025-icon.png') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <script src="{{ mix('js/init.js') }}"></script>

    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen" style="background-color: #8b9a9a14;" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('components.dashboard.sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('components.dashboard.header')
            <main class="h-full overflow-y-auto bg-primaryPoi25-50">
                <div class="container grid px-6 mx-auto">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 capitalize">
                        {{-- {{ __('dashboard.' . $title) }} --}}
                        {{ __($title) }}
                    </h2>

                    {{ $slot }}

                </div>
            </main>
        </div>
    </div>

    <!-- Payment Notification Modal -->
    @include('components.payment-notification-modal')
</body>
@livewireScripts
<script src="{{ mix('js/notification.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
@stack('scripts')

</html>
