<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- stylesheet --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" />
    <link href="{{ asset('/static/css/main.css') }}" rel="stylesheet">

    {{-- fonts.google.com : Archivo --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
    <link href="https://fonts.googleapis.com/css2?family=Archivo&display=swap" rel="stylesheet" />

    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo.svg') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.svg') }}" />

    {{-- title and descriptioan --}}
    <title>Poisson : Pekan Olimpiade Statistika Nasional</title>
    <meta name="description"
        content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingakt nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />

    {{-- meta opengraph --}}
    <meta property="og:site_name" content="https://poisson.stis.ac.id" />
    <meta property="og:title" content="Poisson : Pekan Olimpiade Statistika Nasional" />
    <meta property="og:description"
        content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingakt nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />
    <meta property="og:image" content="https://poisson.stis.ac.id/static/landing-page.png" />
    <meta property="og:type" content="website" />

    {{-- twitter card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Poisson : Pekan Olimpiade Statistika Nasional" />
    <meta name="twitter:description"
        content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingakt nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />
    <meta name="twitter:image" content="https://poisson.stis.ac.id/static/landing-page.png" />
</head>

<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">{{ $slot }}</div>
    <script src="{{ asset('/static/js/main.js') }}"></script>
</body>

</html>
