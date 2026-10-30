<div>
    <x-button-link href="{{ route('osc.edit', $row) }}" class="mx-1 text-xs" wire:click="">EDIT</x-button-link>
    <x-danger-button class="mx-1" wire:click="delete({{ $row->id }})">HAPUS</x-button>
</div>
