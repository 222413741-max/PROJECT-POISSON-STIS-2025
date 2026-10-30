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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" />
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo:wght@700&family=Inter:wght@400;500;700&family=Lato:wght@900&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">

    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-2025-icon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-2025-icon.png') }}" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

    {{-- title and descriptioan --}}
    <title>Poisson Statistics Competition | Politeknik Statistika STIS</title>
    <meta name="description"
        content="The Poisson Statistics Competition is annual event organized by UKM Forkas (Information Forum and Statistical Studies) in collaboration with BEM Politeknik Statistika STIS." />

    {{-- meta opengraph --}}
    <meta property="og:site_name" content="https://poisson.stis.ac.id" />
    <meta property="og:title" content="Poisson Statistics Competition | Politeknik Statistika STIS" />
    <meta property="og:description"
        content="The Poisson Statistics Competition is annual event organized by UKM Forkas (Information Forum and Statistical Studies) in collaboration with BEM Politeknik Statistika STIS." />
    <meta property="og:image" content="{{ asset('img/landing-page.png') }}" />
    <meta property="og:type" content="website" />

    {{-- twitter card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Poisson Statistics Competition | Politeknik Statistika STIS" />
    <meta name="twitter:description"
        content="The Poisson Statistics Competition is annual event organized by UKM Forkas (Information Forum and Statistical Studies) in collaboration with BEM Politeknik Statistika STIS." />
    <meta name="twitter:image" content="{{ asset('img/landing-page.png') }}" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
