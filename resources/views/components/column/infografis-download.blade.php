<div class="flex">
    @if ($row->infografis->infografis)
        <div class="mx-1">
            <x-download-button href="{{ $infografisUrl }}">Infografis</x-download-button>
        </div>
    @endif
    @if ($row->infografis->ppt)
        <div class="mx-1">
            <x-download-button href="{{ $pptUrl }}">PPT</x-download-button>
        </div>
    @endif
    <div class="mx-1">
        @livewire('misc.modal-text', ['title' => $row->infografis->name, 'text' => $row->infografis->description], key($row->id))
    </div>
</div>
