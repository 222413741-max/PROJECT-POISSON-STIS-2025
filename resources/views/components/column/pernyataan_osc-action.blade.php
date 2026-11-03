<div>
    @if ($row->getPernyataanOsc())
    <x-download-button class="mx-2" href="{{ $row->getPernyataanOsc()->pernyataan_url }}" target="_blank" rel="noopener noreferrer">
        buka
    </x-download-button> 
    @endif
    {{--
        row (Team Model) : dari query builder di folder livewire
    --}}
    @if ($row->hasPermissionTo('fail'))
        <x-badges.error name="Tidak Lolos" />
        <span class="ml-2">
            <x-danger-button wire:click="cancelFail({{ $row->id }})">
                Batal
            </x-danger-button>
        </span>
    @elseif ($row->hasPermissionTo('osc_semifinal_peserta'))
        <x-badges.success name="Lolos Pernyataan" />
        <span class="ml-2">
            <x-danger-button wire:click="cancelLolos({{ $row->id }}, 'Penyisihan')">
                Batal
            </x-danger-button>
        </span>
    @else
        @if ($row->getPernyataanOsc())
            <x-button class="mx-2 dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700" wire:click="assignLolos({{ $row->id }}, 'penyisihan')">
                Loloskan
            </x-button>
        @endif
        <x-danger-button wire:click="assignFail({{ $row->id }})">
            Gagal
        </x-danger-button>
    @endif
</div>
