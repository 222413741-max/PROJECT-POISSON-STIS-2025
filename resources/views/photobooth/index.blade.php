<?php
session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'id';
}

if (isset($_GET['lang'])) {
    $_SESSION['language'] = $_GET['lang'];
}

$currentLang = $_SESSION['language'];

$translations = [
    'id' => [
        'app_title' => 'Aplikasi Photobooth',
        'back_button' => '← Kembali',
        'choose_photos' => 'Pilih Jumlah Foto',
        'photos_3' => '3 Foto',
        'photos_4' => '4 Foto',
        'photos_6' => '6 Foto',
        'take_photo' => 'Cekrek!',
        'photo_label' => 'Foto',
        'language_code' => 'ID',
        'countdown_message_smile' => 'SENYUM!',
        'countdown_message_remaining' => 'foto lagi!',
        'countdown_message_last' => 'Yang terakhir!',
        'message_success' => 'Kamu keren banget!',
        'camera_denied' => 'Akses kamera ditolak. Mohon aktifkan izin kamera.',
        'edit_photo' => 'EDIT FOTO',
        'retake_photo' => 'FOTO ULANG',
        'stickers_title' => 'Stiker',
        'stickers_instruction_1' => '- Klik stiker lalu klik pada foto untuk menambahkan',
        'stickers_instruction_2' => '- Drag stiker untuk mengubah posisi',
        'stickers_instruction_3' => '- Double klik untuk menghapus stiker',
        'background_title' => 'Latar Belakang',
        'background_instruction' => 'Mengubah warna latar belakang frame photo strip',
        'custom_color' => 'Warna Custom:',
        'filters_title' => 'Filter',
        'filter_normal' => 'Normal',
        'filter_grayscale' => 'Hitam Putih',
        'filter_vintage' => 'Vintage',
        'filter_bright' => 'Cerah',
        'download_button' => 'Unduh Photostrip',
        'retake_final_button' => 'Foto Ulang',
        'date_text' => "I'm Ready For"
    ],
    'en' => [
        'app_title' => 'Photobooth Application',
        'back_button' => '← Back',
        'choose_photos' => 'Choose Number of Photos',
        'photos_3' => '3 Photos',
        'photos_4' => '4 Photos',
        'photos_6' => '6 Photos',
        'take_photo' => 'Snap!',
        'photo_label' => 'Photo',
        'language_code' => 'EN',
        'countdown_message_smile' => 'SMILE!',
        'countdown_message_remaining' => 'photos left!',
        'countdown_message_last' => 'One last photo!',
        'message_success' => 'You look amazing!',
        'camera_denied' => 'Camera access denied. Please enable camera permissions.',
        'edit_photo' => 'EDIT PHOTO',
        'retake_photo' => 'RETAKE',
        'stickers_title' => 'Stickers',
        'stickers_instruction_1' => '- Click a sticker and then click on the photo to add it',
        'stickers_instruction_2' => '- Drag the sticker to change its position',
        'stickers_instruction_3' => '- Double click to remove a sticker',
        'background_title' => 'Background',
        'background_instruction' => 'Change the background color of the photo strip frame',
        'custom_color' => 'Custom Color:',
        'filters_title' => 'Filters',
        'filter_normal' => 'Normal',
        'filter_grayscale' => 'Grayscale',
        'filter_vintage' => 'Vintage',
        'filter_bright' => 'Bright',
        'download_button' => 'Download Photostrip',
        'retake_final_button' => 'Retake',
        'date_text' => "I'm Ready For"
    ]
];

$t = $translations[$currentLang];
?>
<!DOCTYPE html>
<html lang="<?php echo session('language', 'id'); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- stylesheet --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC:wght@400;700&family=Lato:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">
    <link href="{{ asset('/static/css/main.css') }}" rel="stylesheet">

    {{-- fonts.google.com : Archivo --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
    <link href="https://fonts.googleapis.com/css2?family=Archivo&display=swap" rel="stylesheet" />

    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-2025-icon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-2025-icon.png') }}" />

    {{-- title and description --}}
    <title>Poisson Statistics Competition | Politeknik Statistika STIS</title>
    <meta name="description"
        content="Photobooth interaktif POISSON {{ date('Y') }} - Pekan Olimpiade Statistika Nasional. Ambil foto strip dengan stiker dan filter menarik untuk memeriahkan POISSON 2025." />

    {{-- meta opengraph --}}
    <meta property="og:site_name" content="https://poisson.stis.ac.id" />
    <meta property="og:title" content="Photobooth - POISSON {{ date('Y') }}" />
    <meta property="og:description"
        content="Photobooth interaktif POISSON {{ date('Y') }} - Pekan Olimpiade Statistika Nasional. Ambil foto strip dengan stiker dan filter menarik untuk memeriahkan POISSON 2025." />
    <meta property="og:image" content="https://poisson.stis.ac.id/img/photobooth-preview.png" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://poisson.stis.ac.id/photobooth" />

    {{-- twitter card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Photobooth - POISSON {{ date('Y') }}" />
    <meta name="twitter:description"
        content="Photobooth interaktif POISSON {{ date('Y') }} - Pekan Olimpiade Statistika Nasional. Ambil foto strip dengan stiker dan filter menarik untuk memeriahkan POISSON 2025." />
    <meta name="twitter:image" content="https://poisson.stis.ac.id/img/photobooth-preview.png" />

    {{-- Additional meta for camera/media permissions --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="theme-color" content="#1e40af">
    
    <link rel="stylesheet" href="{{ mix('css/photobooth.css') }}">
</head>

<body>
    {{-- <img src="{{ asset('img/photobooth/hiasan-bg-3.png') }}" alt="" class="bg-layer-3"> --}}
    {{-- <img src="{{ asset('img/photobooth/hiasan-bg-2.png') }}" alt="" class="bg-layer-2"> --}}
    <img src="{{ asset('img/photobooth/hiasan-bg-1.png') }}" alt="" class="bg-layer-1">
    
    <div class="flower-decoration"></div>
    
    <a href="/comingsoon" class="back-button" id="backButton">
        <span></span>
        <?php echo $t['back_button']; ?>
    </a>

    <div class="container">
        <div class="container-logo">
            <img src="{{ asset('img/logo-2025-icon.png') }}" alt="Poisson 2025 Logo">
        </div>
        
        <div class="language-dropdown">
            <div class="language-switcher" id="languageSwitcher">
                <span id="languageFlag" class="fi fi-<?php echo $currentLang === 'en' ? 'us' : 'id'; ?>" style="font-size:20px"></span>
                <span id="languageCode"><?php echo $t['language_code']; ?></span>
                <svg class="dropdown-arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                </svg>
            </div>
            <div class="dropdown-content">
                <a href="#" data-lang="en">
                    <span class="fi fi-us" style="font-size:16px"></span>
                    EN
                </a>
                <a href="#" data-lang="id">
                    <span class="fi fi-id" style="font-size:16px"></span>
                    ID
                </a>
            </div>
        </div>

        <div id="photoCountSelector" class="photo-count-selector">
            <h3 id="choosePhotosTitle" style="position: relative;"><?php echo $t['choose_photos']; ?></h3>
            <div class="count-options">
                <div class="count-option active" data-count="3" id="photos3"><?php echo $t['photos_3']; ?></div>
                <div class="count-option" data-count="4" id="photos4"><?php echo $t['photos_4']; ?></div>
                <div class="count-option" data-count="6" id="photos6"><?php echo $t['photos_6']; ?></div>
            </div>
        </div>

        <div class="message-area">
            <div id="countdownDisplay" class="countdown hidden"></div>
            <div id="messageDisplay" class="message hidden"></div>
        </div>

        <div id="cameraSection" class="camera-section">
            <video id="videoElement" autoplay playsinline muted></video>
            <button id="takePhotoBtn" class="take-photo-btn"><?php echo $t['take_photo']; ?></button>
        </div>

        <div id="photosSection" class="photos-section">
            <div class="photos-grid" id="photosGrid">
                <div class="photo-placeholder" id="photo1">
                    <span style="color: #999; font-size: 14px;"><?php echo $t['photo_label']; ?> 1</span>
                </div>
                <div class="photo-placeholder" id="photo2">
                    <span style="color: #999; font-size: 14px;"><?php echo $t['photo_label']; ?> 2</span>
                </div>
                <div class="photo-placeholder" id="photo3">
                    <span style="color: #999; font-size: 14px;"><?php echo $t['photo_label']; ?> 3</span>
                </div>
            </div>
        </div>

        <div id="actionButtons" class="action-buttons hidden">
            <button class="btn btn-edit" id="editBtn">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.5 9.5L4 13l.646-1.646 9.5-9.5z" />
                    <path fill-rule="evenodd" d="M1 13.5V16h2.5l9.354-9.354-2.5-2.5L1 13.5zM2 14v-1.5L11.5 3.5l1.5 1.5L3.5 15H2z" />
                </svg>
                <?php echo $t['edit_photo']; ?>
            </button>
            <button class="btn btn-retake" id="retakeBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 6px;">
                    <path d="M11.534 7H15a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 10.5 7h1.07a4.998 4.998 0 0 0-4.47-3 5 5 0 1 0 4.47 8H11a4 4 0 1 1-3.995-5z" />
                </svg>
                <?php echo $t['retake_photo']; ?>
            </button>
        </div>

        <div id="editSection" class="edit-section">
            <div class="photo-strip-container">
                <div class="photo-strip" id="photoStrip">
                    <div class="strip-photos" id="stripPhotos">
                        </div>
                    <div class="strip-date">
                        I'm Ready For
                        <img src="{{ asset('img/logo-2025-icon.png') }}" alt="Poisson 2025" class="strip-date-poisson-logo">
                    </div>
                </div>
            </div>

            <div class="edit-controls">
                <div class="control-group">
                    <h3 id="stickersTitle"><?php echo $t['stickers_title']; ?></h3>
                    <div class="stickers-grid">
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/poisson1.png') }}">
                            <img src="{{ asset('img/stiker/poisson1.png') }}" alt="Poisson">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/poisson2.png') }}">
                            <img src="{{ asset('img/stiker/poisson2.png') }}" alt="Poisson">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/poisson3.png') }}">
                            <img src="{{ asset('img/stiker/poisson3.png') }}" alt="Poisson">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/dumbooctopus1.png') }}">
                            <img src="{{ asset('img/stiker/dumbooctopus1.png') }}" alt="Dumbo Octopus">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/dumbooctopus2.png') }}">
                            <img src="{{ asset('img/stiker/dumbooctopus2.png') }}" alt="Dumbo Octopus">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/dumbooctopus3.png') }}">
                            <img src="{{ asset('img/stiker/dumbooctopus3.png') }}" alt="Dumbo Octopus">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/anglerfish1.png') }}">
                            <img src="{{ asset('img/stiker/anglerfish1.png') }}" alt="Anglerfish">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/anglerfish2.png') }}">
                            <img src="{{ asset('img/stiker/anglerfish2.png') }}" alt="Anglerfish">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/anglerfish3.png') }}">
                            <img src="{{ asset('img/stiker/anglerfish3.png') }}" alt="Anglerfish">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/blobfish1.png') }}">
                            <img src="{{ asset('img/stiker/blobfish1.png') }}" alt="Blobfish">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/blobfish2.png') }}">
                            <img src="{{ asset('img/stiker/blobfish2.png') }}" alt="Blobfish">
                        </div>
                        <div class="sticker" data-sticker-url="{{ asset('img/stiker/blobfish3.png') }}">
                            <img src="{{ asset('img/stiker/blobfish3.png') }}" alt="Blobfish">
                        </div>
                    </div>
                    <div class="instructions" id="instructions1"><?php echo $t['stickers_instruction_1']; ?></div>
                    <div class="instructions" id="instructions2"><?php echo $t['stickers_instruction_2']; ?></div>
                    <div class="instructions" id="instructions3"><?php echo $t['stickers_instruction_3']; ?></div>
                </div>

                <div class="control-group">
                    <h3 id="backgroundTitle"><?php echo $t['background_title']; ?></h3>
                    <div class="color-options">
                        <div class="color-option active" style="background: #000" data-photo-bg="black"></div>
                        <div class="color-option" style="background: #fff; border: 1px solid #ccc" data-photo-bg="white"></div>
                        <div class="color-option" style="background: #ff69b4" data-photo-bg="pink"></div>
                        <div class="color-option" style="background: #87ceeb" data-photo-bg="lightblue"></div>
                        <div class="color-option" style="background: #98fb98" data-photo-bg="lightgreen"></div>
                        <div class="color-option" style="background: #dda0dd" data-photo-bg="plum"></div>
                    </div>
                    <div class="custom-color-picker">
                        <label for="customColorPicker" id="customColorLabel"><?php echo $t['custom_color']; ?></label>
                        <input type="color" id="customColorPicker" value="#000000">
                    </div>
                    <div class="instructions" id="backgroundInstruction"><?php echo $t['background_instruction']; ?></div>
                </div>

                <div class="control-group">
                    <h3 id="filtersTitle"><?php echo $t['filters_title']; ?></h3>
                    <div class="filter-options">
                        <div class="filter-btn active" data-filter="normal" id="filterNormal"><?php echo $t['filter_normal']; ?></div>
                        <div class="filter-btn" data-filter="sepia" id="filterSepia">Sepia</div>
                        <div class="filter-btn" data-filter="grayscale" id="filterGrayscale"><?php echo $t['filter_grayscale']; ?></div>
                        <div class="filter-btn" data-filter="vintage" id="filterVintage"><?php echo $t['filter_vintage']; ?></div>
                        <div class="filter-btn" data-filter="bright" id="filterBright"><?php echo $t['filter_bright']; ?></div>
                    </div>
                </div>

                <div class="final-buttons">
                    <button class="btn btn-download" id="downloadBtn">⬇ <?php echo $t['download_button']; ?></button>
                    <button class="btn btn-retake-final" id="retakeFinalBtn"><x-icons.camera /><?php echo $t['retake_final_button']; ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.translations = @json($translations);
        window.currentLang = '{{ $currentLang }}';
    </script>
    <script src="{{ mix('js/photobooth.js') }}"></script>
</body>

</html>
