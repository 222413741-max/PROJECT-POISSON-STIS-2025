<form wire:submit.prevent="createteam" x-data="{ photoName: 'Silahkan pilih file' }">
    <div class="xl:w-1/2 mt-3 mb-5">
        @if ($lomba == 'olimpiade')
            <x-download-button href="#" class="text-black bg-green-100" target="_blank" rel="noopener noreferrer"
                download="false">
                Dapatkan Diskon Pendaftaran
            </x-download-button>
        @endif
        @if ($lomba == 'infografis')
            <x-download-button href="https://forms.gle/RQm3wPxn7M73e5GK7" class="text-black bg-green-100" target="_blank"
                rel="noopener noreferrer" download="false">
                Dapatkan Diskon Pendaftaran
            </x-download-button>
        @endif
    </div>
</form>
