<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', App::getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-2025-icon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-2025-icon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Playfair+Display+SC:wght@400;700&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        body {
            background-image: url("{{ asset('img/autentikasi/Desktop-Login.png') }}");
            background-repeat: repeat;
            background-attachment: fixed;
            overflow-x: hidden;
            background-size: auto;
        }
        .bottom-decoration {
            position: fixed;       
            bottom: 0;
            left: 0;
            width: 100%;           
            height: auto;          
            max-height: 900px;     
            pointer-events: none;
            z-index: 5;
        }

        .flower-top-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 1600px;   
            height: 1100px;  
            overflow: hidden;
            z-index: 5;
        }

        .flower-top-right img {
            position: absolute;
            top: -650px;     
            right: -750px;   
            width: 4000px;   
            height: auto;    
        }

        .manta-ray {
            position: fixed;
            top: 41px;         
            left: 220px;       
            width: 416px;     
            height: 521px;    
            z-index: 6;       
            pointer-events: none; 
        }

        .starfish {
            position: fixed;
            top: 248px;
            left: 896px;
            width: 226px;
            height: 283px;
            z-index: 6;
            pointer-events: none; 
        }

        @media (max-width: 768px) {
            .manta-ray {
                top: 122px;      
                left: 47px;     
                width: 305px;   
                height: 381px;  
            }

            .starfish {
                top: 346px;     
                left: 491px;    
                width: 188px;   
                height: 235px;  
            }


            .flower-top-right {
                position: fixed;
                top: 0;
                right: 0;
                width: 1600px;  
                height: 1100px; 
                overflow: hidden;
                z-index: 5;
            }

            .flower-top-right img {
                position: absolute;
                top: -650px;    
                right: -1000px; 
                width: 4000px;  
                height: auto;   
            }

            .bottom-decoration {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;    
                height: auto;   
                max-height: 900px; 
                pointer-events: none;
                z-index: 5;
            }
        }

    </style>
</head>

<body>
    <div class="wrapper font-sans relative z-10">
        {{ $slot }}
    </div>

    <!-- Bunga pojok kanan atas -->
    <div class="flower-top-right">
        <img src="{{ asset('img/autentikasi/bunga.png') }}" alt="Flower Decoration">
    </div>

    <!-- Ikan Pari -->
    <img src="{{ asset('img/autentikasi/Pari.png') }}" alt="Manta Ray" class="manta-ray">
    <!-- Bintang Laut -->
    <img src="{{ asset('img/autentikasi/Starfish.png') }}" alt="Starfish" class="starfish">
    <!-- Karang -->
    <img src="{{ asset('img/autentikasi/Karang.png') }}" alt="Bottom Decoration" class="bottom-decoration">

</body>

</html>
