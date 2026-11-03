<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- fonts.google.com --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" />
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

  {{-- Logo --}}
  <link rel="shortcut icon" href="{{ asset('img/logo.svg') }}" type="image/x-icon">
  <link rel="apple-touch-icon" href="{{ asset('img/logo.svg') }}" />

  {{-- title and descriptioan --}}
  <title>Poisson : Pekan Olimpiade Statistika Nasional</title>
  <meta name="description"
    content="Poisson atau Pekan Olimpiade Statistika Nasional merupakan program kerja tingkat nasional yang diselenggarakan oleh UKM Pendidikan dan Kebudayaan Bidang Forkas di bawah naungan Senat Mahasiswa Polstat STIS." />

    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>

<body>
  @inertia
</body>

</html>
