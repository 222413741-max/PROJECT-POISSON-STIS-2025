<div class="flex">
    @if ($row->link)
        <div class="mx-1">
            <x-download-button href="{{ $row->link }}" target="_blank" rel="noopener noreferrer">
                {{ __('dashboard.buka tautan') }}
            </x-download-button>
        </div>
    @endif
    @if ($row->description)
        <div class="mx-1">
            @livewire('misc.modal-text', ['title' => $row->name, 'text' => $row->description], key($row->id))
        </div>
    @endif
    @role('admin')
        <div class="mx-1">
            <x-danger-button wire:click="delete({{ $row->id }})">{{ __('dashboard.hapus') }}</x-button>
        </div>
    @endif
</div>
