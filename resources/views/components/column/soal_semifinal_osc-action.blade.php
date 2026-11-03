<div>
    <x-download-button class="mx-2" href="{{ getGoogleDocsLink($row->soal_url) }}" target="_blank" rel="noopener noreferrer">
        buka
    </x-download-button>
    <x-download-button class="mx-2" href="{{ $row->soal_url }}">unduh</x-download-button>
    <x-danger-button class="mx-2" wire:click="delete({{ $row->id }})">hapus</x-button>
</div>  
 